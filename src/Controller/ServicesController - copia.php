<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

use Cake\I18n\Time;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 */
class ServicesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['searchService']);
    }
	
    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] == 'Auditor(a) externo' || $user['role'] == 'Auditor(a) interno' || $user['role'] == 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['index']))
                {
                    return true;
                }
            }  
		}
		return parent::isAuthorized($user);
	}

    public function testFunction()
    {
        $this->autoRender = false;
        
        $cadena = 
        'cadena
        de
        texto
        '; 

        echo nl2br(htmlentities($cadena));
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ($this->request->is('post')) 
        {
            foreach ($_POST['service'] as $servicePost)
            {
                $service = $this->Services->get($servicePost['id']);
                
                if (substr($servicePost['cost_bolivars'], -3, 1) == ',')
                {
                    $replace1= str_replace('.', '', $servicePost['cost_bolivars']);
                    $replace2 = str_replace(',', '.', $replace1);
                    $service->cost_bolivars = $replace2;
                }
                else
                {
                    $service->cost_bolivars = $servicePost['cost_bolivars'];
                }
            
                if (substr($servicePost['cost_dollars'], -3, 1) == ',')
                {
                    $replace1= str_replace('.', '', $servicePost['cost_dollars']);
                    $replace2 = str_replace(',', '.', $replace1);
                    $service->cost_dollars = $replace2;
                }
                else
                {
                    $service->cost_dollars = $servicePost['cost_dollars'];
                }

                if (!($this->Services->save($service))) 
                {
                    $this->Flash->error(__('No se pudo actualizar el presupuesto identificado con el id: ' . $servicePost['id']));
                }
            }
        }

        $clinicalServices = TableRegistry::get('Services');
        
        $arrayResult = $clinicalServices->find('services', ['conditions' => ['registration_status' => 'ACTIVO']]);
        
        if ($arrayResult['indicator'] == 0)
        {
            $services = $arrayResult['searchRequired'];
        }
        else
        {
            $this->Flash->error(__('No se encontraron servicios'));
        }
        
        $currentView = 'servicesIndex'; 
        
        $this->set(compact('services', 'currentView'));
        $this->set('_serialize', ['services', 'currentView']);
    }
    
    public function specialIndex()
    {
        $clinicalServices = TableRegistry::get('Services');
        
        $arrayResult = $clinicalServices->find('services', ['conditions' => ['registration_status <>' => 'ACTIVO']]);

        if ($arrayResult['indicator'] == 0)
        {
            $services = $arrayResult['searchRequired'];
        }
        else
        {
            $this->Flash->error(__('No se encontraron servicios'));
        }
        
        $currentView = 'servicesIndex'; 
        
        $this->set(compact('services', 'currentView'));
        $this->set('_serialize', ['services', 'currentView']);
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $controller = null, $action = null)
    {
        if ($this->request->is('post'))
        {
            $id = $_POST['id'];
            $controller = $_POST['controller'];
            $action = $_POST['action'];
        }            

        $service = $this->Services->get($id);

        $currentView = 'ServicesView';

        $this->set('service', $service);
        $this->set(compact('controller', 'action', 'currentView'));
        $this->set('_serialize', ['service', 'controller', 'action', 'currentView']);
    
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($controller = null, $action = null)
    {
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) 
        {
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();

            $service = $this->Services->patchEntity($service, $this->request->data);
            
            $serviceTrim = trim($service->service_description);
            
            $service->service_description = strtoupper($serviceTrim);

            if (substr($_POST['cost_bolivars'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['cost_bolivars']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->cost_bolivars = $replace2;
            }
            
            if (substr($_POST['cost_dollars'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['cost_dollars']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->cost_dollars = $replace2;
            }
            
            $service->registration_status = 'ACTIVO';

            $service->reason_status = 'NUEVO SERVICIO';

            $service->date_status = $currentDate;

            if ($this->Services->save($service)) 
            {
                $this->Flash->success(__('El servicio médico fue registrado exitosamente'));

                return $this->redirect(['controller' => $controller, 'action' => $action]);
            }
            $this->Flash->error(__('El servicio médico, no pudo ser registrado'));
        }
        
        $this->set(compact('service', 'controller', 'action'));
        $this->set('_serialize', ['service', 'controller', 'action']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $controller = null, $action = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $service = $this->Services->patchEntity($service, $this->request->data);
            
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();

            $service->service_description = trim($service->service_description);
            
            $service->service_description = strtoupper($service->service_description);

            if (substr($_POST['cost_bolivars'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['cost_bolivars']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->cost_bolivars = $replace2;
            }
            
            if (substr($_POST['cost_dollars'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['cost_dollars']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->cost_dollars = $replace2;
            }
    
            $service->reason_status = 'REQUERIMIENTO DEL USUARIO';

            $service->date_status = $currentDate;

            if ($this->Services->save($service)) 
            {
                $this->Flash->success(__('Los cambios fueron registrados exitosamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudieron registrar los cambios'));
        }
        $this->set(compact('service', 'controller', 'action'));
        $this->set('_serialize', ['service', 'controller', 'action']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function findService()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            $name = $this->request->query['term'];
            $results = $this->Services->find('all', [
                'conditions' => [['Services.service_description LIKE' => $name . '%'], ['Services.registration_status' => 'ACTIVO']]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['service_description'], 'value' => $result['service_description'], 'id' => $result['id']];
            }

            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }
	
    public function findServiceCost()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            $name = $this->request->query['term'];
            $results = $this->Services->find('all', [
                'conditions' => [['Services.service_description LIKE' => $name . '%'], ['Services.registration_status' => 'ACTIVO'], ['OR' => [['Services.cost_bolivars >' => 0], ['Services.cost_dollars >' => 0]]]]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['service_description'], 'value' => $result['service_description'], 'id' => $result['id']];
            }
            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }
	
    public function searchService($surgery = null)
    {
        $clinicalServices = TableRegistry::get('Services');
   
        $arrayResult = $clinicalServices->find('only', ['conditions' => [['service_description' => $surgery], ['registration_status' => 'ACTIVO']]]);
     
        if ($arrayResult['indicator'] == 0)
        {
            $service = $arrayResult['searchRequired'];
            
            $arrayResult = [];
            
            $arrayResult['indicator'] = 0;
            $arrayResult['costBolivars'] = $service->cost_bolivars;
            $arrayResult['costDollars'] = $service->cost_dollars;
            $arrayResult['itemes'] = $service->itemes;
        }
        else
        {
            $arrayResult = [];
            $arrayResult['indicator'] = 1;
        }
        return $arrayResult;
    }
    public function getService($id = null)
    {
		$service = $this->Services->get($id);
            
        $arrayResult = [];
            
		$arrayResult['costBolivars'] = $service->cost_bolivars;
		$arrayResult['costDollars'] = $service->cost_dollars;
		$arrayResult['itemes'] = $service->itemes;

        return $arrayResult;
    }
}
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
            if ($user['role'] == 'Auditor(a) externo' || $user['role'] == 'Auditor(a) interno' || $user['role'] == 'Administrador(a) de la clínica' )
            {
                if(in_array($this->request->action, ['add', 'edit', 'index', 'findServiceCost', 'specialIndex']))
                {
                    return true;
                }
            }
            if ($user['role'] == 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['index', 'findServiceCost']))
                {
                    return true;
                }
            }			
            elseif ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['findServiceCost']))
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
				
                if (substr($servicePost['national_dollar_cost'], -3, 1) == ',')
                {
                    $replace1= str_replace('.', '', $servicePost['national_dollar_cost']);
                    $replace2 = str_replace(',', '.', $replace1);
                    $service->national_dollar_cost = $replace2;
                }
                else
                {
                    $service->national_dollar_cost = $servicePost['national_dollar_cost'];
                }
				/*
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
				*/
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
            
            if (substr($_POST['cost_dollars'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['cost_dollars']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->cost_dollars = $replace2;
            }
			
            if (substr($_POST['national_dollar_cost'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['national_dollar_cost']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->national_dollar_cost = $replace2;
            }
            
			$this->loadModel('Systems');
			
			$system = $this->Systems->get(2);
			
			$tasaDolar = $system->dollar_rate;

			$service->cost_bolivars = $service->national_dollar_cost * $tasaDolar;

			$service->service_code = "";
			
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
            
            if (substr($_POST['cost_dollars'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['cost_dollars']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->cost_dollars = $replace2;
            }
			
            if (substr($_POST['national_dollar_cost'], -3, 1) == ',')
            {
                $replace1= str_replace('.', '', $_POST['national_dollar_cost']);
                $replace2 = str_replace(',', '.', $replace1);
                $service->national_dollar_cost = $replace2;
            }
			
			$this->loadModel('Systems');
			
			$system = $this->Systems->get(2);
			
			$tasaDolar = $system->dollar_rate;

			$service->cost_bolivars = $service->national_dollar_cost * $tasaDolar;
    
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
            
		$arrayResult['serviceDescription'] = $service->service_description;
		$arrayResult['costBolivars'] = $service->cost_bolivars;
		$arrayResult['costDollars'] = $service->cost_dollars;
		$arrayResult['itemes'] = $service->itemes;

        return $arrayResult;
    }
    public function ajaxService()
    {
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');
			
		if ($this->request->is('json')) 
        {
			$service = $this->Services->get($_POST['id']);
			
            $jsondata["success"] = true;
            $jsondata["data"]["message"] = "Se encontró el servicio";
            $jsondata["data"]['serviceDescription'] = $service->service_description;
            $jsondata["data"]['costBolivars'] = $service->cost_bolivars;;
            $jsondata["data"]['costDollars'] = $service->cost_dollars;
            $jsondata["data"]['itemes'] = nl2br($service->itemes);
			$jsondata["data"]['dateBudget'] = Time::now();
			$expirationDate = Time::now();
			$jsondata["data"]['expirationDate'] = $expirationDate->addDays(3);
			
		exit(json_encode($jsondata, JSON_FORCE_OBJECT));
		}
    }
    public function updateRate()
    {			
        $this->autoRender = false;
		
		// Descomentar solo para pruebas
			$_POST['tasaDolar'] = 337.34
		//
		
		if (isset($_POST['tasaDolar']))
		{
			$jsondata = [];
			
			if (substr($_POST['tasaDolar'], -3, 1) == ',')
			{
				$replace1= str_replace('.', '', $_POST['tasa_dolar']);
				$replace2 = str_replace(',', '.', $replace1);
				$tasaDolar = $replace2;
			}
			else
			{
				$tasaDolar = $_POST['tasaDolar'];
			}
			
			$this->loadModel('Systems');
			
			$system = $this->Systems->get(2);
			
			$system->dollar_rate = $tasaDolar;
					
			if ($this->Systems->save($system)) 
			{
				$clinicalServices = TableRegistry::get('Services');
				
				$arrayResult = $clinicalServices->find('services');
				
				if ($arrayResult['indicator'] == 0)
				{
					$services = $arrayResult['searchRequired'];

					$errorIndicator = 0;
					
					foreach ($services as $service)
					{
						$service->cost_bolivars = $service->national_dollar_cost * $tasaDolar;
						
						if (!($this->Services->save($service))) 
						{
							$errorIndicator = 1;
							$jsondata["success"] = false;
							$jsondata["data"]["message"] = "Error actualizando el servicio ID: " . $service->id;
							break;
						}
					}
					if ($errorIndicator == 0)
					{
						$jsondata["success"] = false;
						$jsondata["data"]["message"] = "La tarifa se actualizó satisfactoriamente. No se encontraron servicios";		
					}
				}
				else
				{
					$jsondata["success"] = false;
					$jsondata["data"]["message"] = "No se pudo actualizar la tarifa";
				}
			}
			else
			{
				$jsondata["success"] = false;
				$jsondata["data"]["message"] = "No se pudo actualizar la tarifa";
			}
		}
		else
		{
			$jsondata["success"] = false;
			$jsondata["data"]["message"] = "No se pudo actualizar la tarifa";
		}
		exit(json_encode($jsondata, JSON_FORCE_OBJECT));
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
            
		$arrayResult['serviceDescription'] = $service->service_description;
		$arrayResult['costBolivars'] = $service->cost_bolivars;
		$arrayResult['costDollars'] = $service->cost_dollars;
		$arrayResult['itemes'] = $service->itemes;

        return $arrayResult;
    }
    public function ajaxService()
    {
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');
			
		if ($this->request->is('json')) 
        {
			$service = $this->Services->get($_POST['id']);
			
            $jsondata["success"] = true;
            $jsondata["data"]["message"] = "Se encontró el servicio";
            $jsondata["data"]['serviceDescription'] = $service->service_description;
            $jsondata["data"]['costBolivars'] = $service->cost_bolivars;;
            $jsondata["data"]['costDollars'] = $service->cost_dollars;
            $jsondata["data"]['itemes'] = nl2br($service->itemes);
			$jsondata["data"]['dateBudget'] = Time::now();
			$expirationDate = Time::now();
			$jsondata["data"]['expirationDate'] = $expirationDate->addDays(3);
			
		exit(json_encode($jsondata, JSON_FORCE_OBJECT));
		}
    }

    public function updateRate()
    {			
        $this->autoRender = false;
		
		// Descomentar solo para pruebas
			$_POST['tasa_dolar'] = 337.34;
		//
		
		if (isset($_POST['tasaDolar']))
		{
			$jsondata = [];
			
			if (substr($_POST['tasaDolar'], -3, 1) == ',')
			{
				$replace1= str_replace('.', '', $_POST['tasaDolar']);
				$replace2 = str_replace(',', '.', $replace1);
				$dollarRate = $replace2;
			}
			else
			{
				$dollarRate = $_POST['tasaDolar'];
			}
			
			$this->loadModel('Systems');
			
			$system = $this->Systems->get(2);
			
			$system->dollar_rate = $dollarRate;
					
			if ($this->Systems->save($system)) 
			{
				$clinicalServices = TableRegistry::get('Services');
			
				$arrayResult = $clinicalServices->find('services');
				
				if ($arrayResult['indicator'] == 0)
				{
					$services = $arrayResult['searchRequired'];

					$errorIndicator = 0;
					
					foreach ($services as $service)
					{					
						$service->cost_bolivars = $service->national_dollar_cost * $dollarRate;
						
						if (!($this->Services->save($service))) 
						{
							$errorIndicator = 1;
							$jsondata["success"] = false;
							$jsondata["data"]["message"] = "Error actualizando el servicio ID: " . $service->id;
							break;
						}
					}
					if ($errorIndicator == 0)
					{
						$jsondata["success"] = false;
						$jsondata["data"]["message"] = "La tarifa se actualizó satisfactoriamente";		
					}
				}
				else
				{
					$jsondata["success"] = false;
					$jsondata["data"]["message"] = "No se pudo actualizar la tarifa. No se encontraron servicios";
				}
			}
			else
			{
				$jsondata["success"] = false;
				$jsondata["data"]["message"] = "No se pudo actualizar la tarifa";
			}
		}
		else
		{
			$jsondata["success"] = false;
			$jsondata["data"]["message"] = "No se pudo actualizar la tarifa";
		}
		exit(json_encode($jsondata, JSON_FORCE_OBJECT));
    }
	
    public function discountSurcharge()
    {			
        $this->autoRender = false;
		
		// Descomentar solo para pruebas
			$_POST['descuentoRecargo'] = -30;
		//
		
		if (isset($_POST['descuentoRecargo']))
		{
			$jsondata = [];
			
			if (substr($_POST['descuentoRecargo'], -3, 1) == ',')
			{
				$replace1= str_replace('.', '', $_POST['descuentoRecargo']);
				$replace2 = str_replace(',', '.', $replace1);
				$discountSurcharge = $replace2;
			}
			else
			{
				$discountSurcharge = $_POST['descuentoRecargo'];
			}
			
			if ($descuentoRecargo < 0)
			{
				$operationType = "Descuento";
				$discountSurcharge = $discountSurcharge * -1;
			}
			else
			{
				$operationType = "Recargo";
			}
			
			$this->loadModel('Systems');
			
			$system = $this->Systems->get(2);
			
			$dollarRate = $system->dollar_rate;
					
			$clinicalServices = TableRegistry::get('Services');
				
			$arrayResult = $clinicalServices->find('services');
				
			if ($arrayResult['indicator'] == 0)
			{
				$services = $arrayResult['searchRequired'];

				$errorIndicator = 0;
				
				foreach ($services as $service)
				{
					$discountAmountSurcharge = $service->national_dollar_cost * $discountSurcharge;
					
					if ($operationType == "Descuento")
					{
						$service->national_dollar_cost = $service->national_dollar_cost - $discountAmountSurcharge;
					}
					else
					{
						$service->national_dollar_cost = $service->national_dollar_cost + $discountAmountSurcharge;
					}
					
					$service->cost_bolivars = $service->national_dollar_cost * $dollarRate;
					
					if (!($this->Services->save($service))) 
					{
						$errorIndicator = 1;
						$jsondata["success"] = false;
						$jsondata["data"]["message"] = "Error actualizando el servicio ID: " . $service->id;
						break;
					}
				}
				if ($errorIndicator == 0)
				{
					$jsondata["success"] = false;
					$jsondata["data"]["message"] = "La tarifa se actualizó satisfactoriamente";		
				}
			}
			else
			{
				$jsondata["success"] = false;
				$jsondata["data"]["message"] = "No se pudo aplicar el descuent/recargo. No se encontraron servicios";
			}
		}
		else
		{
			$jsondata["success"] = false;
			$jsondata["data"]["message"] = "No se pudo actualizar la tarifa";
		}
		exit(json_encode($jsondata, JSON_FORCE_OBJECT));
    }
}
<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

use Cake\I18n\Time;

/**
 * Multilevels Controller
 *
 * @property \App\Model\Table\MultilevelsTable $Multilevels
 */
class MultilevelsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['addWebMultilevel', 'verifyPromoter', 'restore']);
    }
    
    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['add', 'edit', 'restore']))
                {
                    return true;
                }
            }  
            if ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['add', 'edit', 'restore']))
                {
                    return true;
                }
            }  
        }
        return parent::isAuthorized($user);
    }     
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $multilevels = $this->paginate($this->Multilevels);

        $this->set(compact('multilevels'));
        $this->set('_serialize', ['multilevels']);
    }

    /**
     * View method
     *
     * @param string|null $id Multilevel id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $multilevel = $this->Multilevels->get($id, [
            'contain' => []
        ]);

        $this->set('multilevel', $multilevel);
        $this->set('_serialize', ['multilevel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $multilevel = $this->Multilevels->newEntity();
        if ($this->request->is('post')) {
            $multilevel = $this->Multilevels->patchEntity($multilevel, $this->request->data);
            if ($this->Multilevels->save($multilevel)) {
                $this->Flash->success(__('The multilevel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multilevel could not be saved. Please, try again.'));
        }
        $this->set(compact('multilevel'));
        $this->set('_serialize', ['multilevel']);
    }
    public function addAutomatic($idUser = null)
    {
        $this->autoRender = false;
        
        $multilevel = $this->Multilevels->newEntity();
        
        $multilevel->user_id = $idUser;
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $multilevel->birthdate = Time::now();
        
        $multilevel->active = true;
        
        $dateDeactivation = new Time('2027-01-01');
        
        $multilevel->deactivation_date = $dateDeactivation;
    
        if ($this->Multilevels->save($multilevel)) 
        {
            $result = 0;
        }
        else
        {
            $result = 1;
        }
        return $result;
        
        $this->set(compact('multilevel'));
        $this->set('_serialize', ['multilevel']);
    }

    public function addWebMultilevel($idUser = null)
    {
        $this->autoRender = false;
        
        $lastRecord = $this->Multilevels->find('all', ['conditions' => ['Multilevels.user_id' => $idUser], 
            'order' => ['Multilevels.created' => 'DESC'] ]);

        $row = $lastRecord->first();
        
        if ($row)
        {
            $result = 2;
        }
        else
        {
            $multilevel = $this->Multilevels->newEntity();
            
            $multilevel->user_id = $idUser;
            
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');
    
            $multilevel->birthdate = Time::now();
            
            $multilevel->active = true;
            
            $dateDeactivation = new Time('2027-01-01');
            
            $multilevel->deactivation_date = $dateDeactivation;
        
            if ($this->Multilevels->save($multilevel)) 
            {
                $result = 0;
            }
            else
            {
                $result = 1;
            }
        }
        
        return $result;
    
    }

    /**
     * Edit method
     *
     * @param string|null $id Multilevel id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $controller = null, $action = null)
    {
        $multilevel = $this->Multilevels->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $multilevel = $this->Multilevels->patchEntity($multilevel, $this->request->data);
            if ($this->Multilevels->save($multilevel)) 
            {
                $this->Flash->success(__('Se completaron los datos del usuario'));

                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error(__('No se pudieron completar los datos del usuario'));
        }
        
        $this->set(compact('multilevel', 'controller', 'action'));
        $this->set('_serialize', ['multilevel', 'controller', 'action']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Multilevel id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $multilevel = $this->Multilevels->get($id);
        $multilevel->deleted_record = true;
        if ($this->Multilevels->save($multilevel)) 
        {
            $result = 0;
        } 
        else 
        {
            $result = 1; 
        }

        return $result;
    }
    public function restore($id = null)
    {
        $multilevel = $this->Multilevels->get($id);
        $multilevel->deleted_record = null;
        if ($this->Multilevels->save($multilevel)) 
        {
            $result = 0;
        } 
        else 
        {
            $result = 1; 
        }

        return $result;
    }
    public function verifyPromoter($idUser = null)
    {

        $multilevels = TableRegistry::get('Multilevels');
        
        $arrayResult = $multilevels->find('only', ['user_id' => $idUser]);
        
        if ($arrayResult['indicator'] == 0)
        {
            $row = $arrayResult['searchRequired'];
            
            if ($row->deleted_record == true)
            {
                $result = $this->restore($row->id);
            }
        }
        else
        {
            $result = 1;
        }
        return $result;
    }
}
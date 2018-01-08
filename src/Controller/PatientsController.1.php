<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\BudgetsController;

use Cake\I18n\Time;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 */
class PatientsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['addWebPatient']);
    }

    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['index', 'edit', 'delete', 'previousPatient', 'restore']))
                {
                    return true;
                }
            }  
            elseif ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['index', 'edit', 'delete', 'previousPatient', 'restore']))
                {
                    return true;
                }                
            }
            elseif ($user['role'] === 'Call center')
            {
                if(in_array($this->request->action, ['index', 'edit', 'delete', 'previousPatient', 'restore']))
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
        $patients = $this->paginate($this->Patients);

        $this->set(compact('patients'));
        $this->set('_serialize', ['patients']);
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $origin = null, $idUser = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => []
        ]);

        $user = $this->Patients->Users->get($patient->user_id);
        
        $this->set(compact('patient', 'origin', 'idUser'));
        $this->set('_serialize', ['patient', 'origin', 'idUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $patient = $this->Patients->newEntity();
        if ($this->request->is('post')) {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        
        $this->set(compact('patient'));
        $this->set('_serialize', ['patient']);
    }

    public function addAutomatic($idUser = null)
    {
        $this->autoRender = false;
        
        $patient = $this->Patients->newEntity();
        
        $patient->user_id = $idUser;
        
        $dateBirthDate = $_POST['birthdate']['year'] . '-' .  $_POST['birthdate']['month'] . '-' . $_POST['birthdate']['day'];
        
        $dateBirthDateConverted = new Time($dateBirthDate);
            
        $patient->birthdate = $dateBirthDateConverted;
        
        $patient->country = $_POST['country'];
        $patient->address = $_POST['address'];
        $patient->profession = $_POST['profession'];
        $patient->sponsor_type = $_POST['sponsor_type'];
        $patient->first_name_emergency = '';            
        $patient->surname_emergency = '';            
        $patient->address_emergency = '';
        $patient->landline_emergency = ''; 
        $patient->cell_phone_emergency = '';

        if ($this->Auth->user('username'))
        {
            $patient->responsible_user = $this->Auth->user('username');
        }

        if ($this->Patients->save($patient)) 
        {
            $lastRecord = $this->Patients->find('all', ['conditions' => ['Patients.responsible_user' => $this->Auth->user('username')], 
                               'order' => ['Patients.created' => 'DESC'] ]);

            $row = $lastRecord->first();
            
            if ($row)
            {
                $idPatient = $row->id;
            }
            else
            {
                $idPatient = 0;
            }
        }
        else
        {
            $idPatient = 0;
        }

        return $idPatient;
    }
    
    public function addWebPatient($idUser = null, $birthdate = null, $country = null, $address = null)
    {
        $this->autoRender = false;
        
        $lastRecord = $this->Patients->find('all', ['conditions' => ['Patients.user_id' => $idUser], 
            'order' => ['Patients.created' => 'DESC'] ]);

        $row = $lastRecord->first();
        
        if ($row)
        {
            $idPatient = $row->id;
        }
        else
        {
            $patient = $this->Patients->newEntity();
            
            $patient->user_id = $idUser;
            
            $dateBirthDateConverted = new Time($birthdate);
                
            $patient->birthdate = $dateBirthDateConverted; 
    
            $patient->country = $country;
            $patient->address = $address;
            $patient->first_name_emergency = '';            
            $patient->surname_emergency = '';            
            $patient->address_emergency = '';
            $patient->landline_emergency = ''; 
            $patient->cell_phone_emergency = '';
    
            $patient->responsible_user = 'clnacional2017';
    
            if ($this->Patients->save($patient)) 
            {
                $lastRecord = $this->Patients->find('all', ['conditions' => ['Patients.responsible_user' => 'clnacional2017'], 
                    'order' => ['Patients.created' => 'DESC'] ]);
    
                $row = $lastRecord->first();
                
                if ($row)
                {
                    $idPatient = $row->id;
                }
                else
                {
                    $idPatient = 0;
                }
            }
            else
            {
                $idPatient = 0;
            }
        }

        return $idPatient;
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $controller = null, $action, $idUser = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => ['Budgets']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) 
            {
                if ($patient->budgets)
                {
                    return $this->redirect(['controller' => 'Budgets', 'action' => 'edit', $patient->budgets[0]['id'], $controller, $action, $idUser]);
                }
            }
            $this->Flash->error(__('No pudieron ser actualizados los datos del paciente'));
        }

        $this->set(compact('patient', 'controller', 'action', 'idUser'));
        $this->set('_serialize', ['patient', 'controller', 'action', 'idUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $budget = new BudgetsController;
        
        $this->request->allowMethod(['post', 'delete']);
        
        $patient = $this->Patients->get($id, [
            'contain' => ['Budgets']]);
        
        $patient->record_deleted = true;

        $result = 0;
        
        if ($this->Patients->save($patient)) 
        {
            if ($patient->budgets)
            {
                foreach ($patient->budgets as $budgetArray)
                {
                    $resultBudget = 0;

                    $resultBudget = $budget->delete($budgetArray->id);
                    
                    if ($resultBudget > 0)
                    {
                        $result = 1; 
                    }
                }
            }
        } 
        else 
        {
            $result = 1;
        }

        return $result;
    }

    public function restore($id = null)
    {
        $this->autoRender = false;

        $budget = new BudgetsController;
              
        $patient = $this->Patients->get($id, [
            'contain' => ['Budgets']]);
        
        $patient->record_deleted = null;

        $result = 0;
        
        if ($this->Patients->save($patient)) 
        {
            if ($patient->budgets)
            {
                foreach ($patient->budgets as $budgetArray)
                {
                    $resultBudget = 0;

                    $resultBudget = $budget->restore($budgetArray->id);
                    
                    if ($resultBudget > 0)
                    {
                        $result = 1; 
                    }
                }
            }
        } 
        else 
        {
            $result = 1;
        }

        return $result;
    }

    
    public function previousPatient()
    {
        
    }

}
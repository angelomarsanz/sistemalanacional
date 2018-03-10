<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\UsersController;

use App\Controller\ServicesController;

use App\Controller\ItemesController;

use App\Controller\DiarypatientsController;

use Cake\I18n\Time;

use Cake\Mailer\Email;

use Cake\Filesystem\File;

use Cake\ORM\TableRegistry;

/**
 * Budgets Controller
 *
 * @property \App\Model\Table\BudgetsTable $Budgets
 */
class BudgetsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['addWebBudget', 'restore']);
    }

    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['edit', 'view', 'budget', 'multilevel', 'addBudget', 'restore', 'delete']))
                {
                    return true;
                }
            }  
            elseif ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['edit', 'view', 'budget', 'multilevel', 'addBudget', 'restore', 'delete']))
                {
                    return true;
                }                
            }
            elseif ($user['role'] === 'Call center')
            {
                if(in_array($this->request->action, ['edit', 'view', 'budget', 'multilevel', 'addBudget', 'restore']))
                {
                    return true;
                }                
            }

        }
        return parent::isAuthorized($user);
    }
    
    public function testFunction()
    {
        $budgets = TableRegistry::get('Budgets');
        
        $arrayResult = $budgets->find('only', ['patient_id' => '2', 'surgery' => 'Mastopexia + Dermolipectomía + Lipoescultura']);
        
        if ($arrayResult['indicator'] == 0)
        {
            $row = $arrayResult['searchRequired'];
        }
        
        $this->Flash->success(__('responsible_user: ' . $row->responsible_user));
    }

     /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $budgets = $this->paginate($this->Budgets);

        $this->set(compact('budgets'));
        $this->set('_serialize', ['budgets']);
    }

    /**
     * View method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $namePatient = null, $namePromoter = null, $cellPromoter = null, $emailPromoter = null, $controller = null, $action = null, $idUser = null, $idPromoter = null)
    {
        $budgetI = $this->Budgets->get($id, [
            'contain' => ['Itemes']
        ]);
		
		if ($budgetI->itemes)
		{
			$itemes = nl2br(htmlentities($budgetI->itemes[0]->itemes));    
		}
		else
		{
			$itemes = '';
		}
		
        $budgets = TableRegistry::get('Budgets');
        
        $arrayResult = $budgets->find('budget', ['id' => $id]);
        
        if ($arrayResult['indicator'] == 0)
        {
            $budget = $arrayResult['searchRequired'];
		}
		else
		{
			$this->Flash->error(__('No se encontró el presupuesto'));
		}

        $this->set('budget', $budget);
        $this->set('_serialize', ['budget']);
        $this->set(compact('namePatient', 'namePromoter', 'cellPromoter', 'emailPromoter', 'controller', 'action', 'itemes', 'idUser', 'idPromoter'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $budget = $this->Budgets->newEntity();
        if ($this->request->is('post')) {
            $budget = $this->Budgets->patchEntity($budget, $this->request->data);
            if ($this->Budgets->save($budget)) {
                $this->Flash->success(__('The budget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The budget could not be saved. Please, try again.'));
        }
        $this->set(compact('budget'));
        $this->set('_serialize', ['budget']);
    }
    public function addAutomatic($idPatient = null, $surgery = null, $coin = null, $cost = null)
    {
        $this->autoRender = false;

		$budget = $this->Budgets->newEntity();
		
		$budget->patient_id = $idPatient;
 
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
		date_default_timezone_set('America/Caracas');
		
		$expirationDate = Time::now();

		$budget->application_date = Time::now();  

		$budget->surgery = $surgery;
		
		$budget->coin = $coin;
		
		$budget->activity_date_finish = Time::now(); 
		
		$budget->activity_result = "SIN CONFIRMAR";
		
		$budget->detailed_result_activity = 'PRESUPUESTO NUEVO';

		$budget->date_budget = Time::now();
		
		$expirationDate = Time::now();
		
		$budget->expiration_date = $expirationDate->addDays(3);
		
		$budget->amount_budget = $cost;
	
        if ($this->Auth->user('username'))
        {
            $budget->responsible_user = $this->Auth->user('username');
        }

		if ($this->Budgets->save($budget)) 
		{
			$lastRecord = $this->Budgets->find('all', ['conditions' => [['Budgets.surgery' => $surgery], ['Budgets.responsible_user' => $this->Auth->user('username')]], 
				'order' => ['Budgets.created' => 'DESC'] ]);

			$row = $lastRecord->first();
			
			if ($row)
			{
				$budget = $this->Budgets->get($row->id);
	
				$budget->number_budget = 'APP-' . $row->id;
				
				if ($this->Budgets->save($budget)) 
				{
					$arrayResult['indicator'] = 0;
					$arrayResult['id'] = $row->id;
					$arrayResult['codeBudget'] = $budget->number_budget;
					$arrayResult['dateBudget'] = $budget->date_budget;
					$arrayResult['expirationDate'] = $budget->expiration_date;
				}
			}
			else
			{
				$arrayResult['indicator'] = 1;
			}
		}
		else
		{
			$arrayResult['indicator'] = 1;
		}
		return $arrayResult;
    }
    
    public function addWebBudget($idPatient = null, $surgery = null, $coin = null, $cost = null)
    {
        $arrayResult = [];

        $this->autoRender = false;

        $toRegister = 0;

        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $lastRecord = $this->Budgets->find('all', ['conditions' => [['patient_id' => $idPatient], ['surgery' => $surgery]], 
            'order' => ['Budgets.created' => 'DESC'] ]);

        $row = $lastRecord->first();
            
        if ($row)        
        {
            $currentDate = time::now();
        
            $currentDate->hour(23)
                ->minute(59)
                ->second(59);
                
            $diferent = $row->application_date->diff($currentDate)->d;
 
            if ($diferent > 3)
            {
                $toRegister = 1;
            }
            else
            {
                $arrayResult['indicator'] = 1;
            }
        }
        else
        {
            $toRegister = 1;
        }
        
        if ($toRegister == 1)
        {
            $budget = $this->Budgets->newEntity();
            
            $budget->patient_id = $idPatient;
     
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');
            
            $expirationDate = Time::now();
    
            $budget->application_date = Time::now();  
    
            $budget->surgery = $surgery;
            
            $budget->coin = $coin;
            
            $budget->activity_date_finish = Time::now(); 
            
            $budget->activity_result = "SIN CONFIRMAR";
            
            $budget->detailed_result_activity = 'PRESUPUESTO NUEVO';

            $budget->date_budget = Time::now();
            
            $expirationDate = Time::now();
            
            $budget->expiration_date = $expirationDate->addDays(3);
            
            $budget->amount_budget = $cost;
        
            $budget->responsible_user = 'clnacional2017';
    
            if ($this->Budgets->save($budget)) 
            {
                $lastRecord = $this->Budgets->find('all', ['conditions' => ['Budgets.responsible_user' => 'clnacional2017'], 
                                   'order' => ['Budgets.created' => 'DESC'] ]);
    
                $row = $lastRecord->first();
                
                if ($row)
                {
                    $budget = $this->Budgets->get($row->id);
        
                    $budget->number_budget = 'APP-' . $row->id;
                    
                    if ($this->Budgets->save($budget)) 
                    {
                        $arrayResult['indicator'] = 0;
                        $arrayResult['id'] = $row->id;
                        $arrayResult['codeBudget'] = $budget->number_budget;
                        $arrayResult['dateBudget'] = $budget->date_budget;
                        $arrayResult['expirationDate'] = $budget->expiration_date;
                    }
                }
                else
                {
                    $arrayResult['indicator'] = 1;
                }
            }
            else
            {
                $arrayResult['indicator'] = 1;
            }
        }

        return $arrayResult;
    }

    /**
     * Edit method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $controller = null, $action = null, $idUser = null)
    {
        $budget = $this->Budgets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $budget = $this->Budgets->patchEntity($budget, $this->request->data);
            if ($this->Budgets->save($budget)) 
            {
                $this->Flash->success(__('Los datos del presupuesto del paciente fueron actualizados exitosamente'));

                return $this->redirect(['controller' => $controller, 'action' => $action, $idUser]);
            }
            $this->Flash->error(__('No pudieron ser actualizados los datos del presupuesto del paciente'));
        }
        $this->set(compact('budget', 'controller', 'action', 'idUser'));
        $this->set('_serialize', ['budget', 'controller', 'action', 'idUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $controller = null, $action = null, $idUser = null, $idPatient = null, $idPromoter = null)
    {
        $diarypatient = new DiarypatientsController;
        
        $this->request->allowMethod(['post', 'delete']);
        $budget = $this->Budgets->get($id, 
            ['contain' => ['Diarypatients']]);
            
        $budget->deleted_record = true;
        
        $result = 0;
            
        if ($this->Budgets->save($budget)) 
        {
            if ($budget->diarypatients)
            {
                foreach ($budget->diarypatients as $diarypatientArray)
                {
                    $resultDiary = 0;

                    $resultDiary = $diarypatient->delete($diarypatientArray->id);
                    
                    if ($resultDiary > 0)
                    {
                        $result = 1;
                    }
                }
            }            
            else
            {
                $result = 0;
            }
        }
        else 
        {
            $result = 1;
        }

        if (isset($controller))
		{	
			if ($controller == 'Diarypatients' && $action == 'index')
			{ 
				return $this->redirect(['controller' => 'Budgets', 'action' => 'budget', $idUser, $idPatient, $idPromoter, $controller, $action]);
			}
			elseif ($controller == 'Users' && $action == 'viewGlobal')
			{ 
				if (isset($idPatient))
				{
					return $this->redirect(['controller' => 'Budgets', 'action' => 'budget', $idUser, $idPatient, $idPromoter, $controller, $action]);
				}
				else
				{
				return $this->redirect(['controller' => $controller, 'action' => $action, $idUser]);	
				}
			}
        }
        return $result;
    }

    public function restore($id = null)
    {
        $this->autoRender = false;
        
        $diarypatient = new DiarypatientsController;
        
        $budget = $this->Budgets->get($id, 
            ['contain' => ['Diarypatients']]);
            
        $budget->deleted_record = null;
        
        $result = 0;
            
        if ($this->Budgets->save($budget)) 
        {
            if ($budget->diarypatients)
            {
                foreach ($budget->diarypatients as $diarypatientArray)
                {
                    $resultDiary = 0;

                    $resultDiary = $diarypatient->restore($diarypatientArray->id);
                    
                    if ($resultDiary > 0)
                    {
                        $result = 1;
                    }
                }
            }            
            else
            {
                $result = 0;
            }
        }
        else 
        {
            $result = 1;
        }

        return $result;
    }

    public function budget($idUser = null, $idPatient = null, $idPromoter = null, $controller = null, $action = null)
    {       
        $patient = $this->Budgets->Patients->get($idPatient);
		
		$user = $this->Budgets->Patients->Users->get($idUser);
		
		$promoter = $this->Budgets->Patients->Users->get($idPromoter);
		
		$this->loadModel('Services');		
		
		$services = $this->Services->find('list', ['limit' => 200, 'conditions' => [['Services.registration_status' => 'ACTIVO'], ['OR' => [['Services.cost_bolivars >' => 0], ['Services.cost_dollars >' => 0]]]], 'order' => ['Services.service_description' => 'ASC']]);
              
        $this->set(compact('patient', 'user', 'promoter', 'controller', 'action', 'services'));
        $this->set('_serialize', ['patient', 'user', 'promoter', 'controller', 'action', 'services']);
    }
    public function correo()
    {
        $email = new Email('default');
            $email->from(['noresponder@cirugiaslanacional.com' => 'Cirugías La Nacional'])
            ->to('transemainc@gmail.com')
            ->subject('Presupuesto solicitado')
            ->send('Presupuesto');
    }
    public function addBudget($id = null, $controller = null, $action = null)
    {       
        $this->autoRender = false;
		
		$arrayMail = [];

        if ($this->request->is('post'))
        {
			$user = new UsersController;
			
			$service = new ServicesController;
			
			$iteme = new ItemesController;
			
            $diarypatient = new DiarypatientsController;
			
            $arrayResult = $service->getService($_POST['service']);

			$arrayMail['mail'] = $_POST['emailPatient'];
			$arrayMail['surgery'] = $arrayResult['serviceDescription'];
			$arrayMail['costBolivars'] = $arrayResult['costBolivars'];
			$arrayMail['costDollars'] = $arrayResult['costDollars'];
			$arrayMail['itemes'] = nl2br(htmlentities($arrayResult['itemes']));
			$itemesBudget = $arrayResult['itemes'];
		      
			if (strtoupper($_POST['countryPatient']) == 'VENEZUELA')
			{
				$arrayResult = $this->addAutomatic($_POST['idPatient'], $arrayResult['serviceDescription'], 'BOLIVAR', $arrayMail['costBolivars']);                            
			}
			else
			{
				$arrayResult = $this->addAutomatic($_POST['idPatient'], $arrayResult['serviceDescription'], 'DOLLAR', $arrayMail['costDollars']);                            
			}

			if($arrayResult['indicator'] == 0)
			{				
				$arrayMail['subject'] = 'Presupuesto ' . $arrayResult['codeBudget']; 
				$arrayMail['firstName'] = $_POST['firstName'];
				$arrayMail['surname'] = $_POST['surname'];
				$arrayMail['identidy'] = $_POST['identificationPatient'];
				$arrayMail['phone'] = $_POST['cellPatient'];
				$arrayMail['address'] = $_POST['addressPatient'];
				$arrayMail['country'] = $_POST['countryPatient'];
				$arrayMail['codeBudget'] = $arrayResult['codeBudget']; 
				$arrayMail['dateBudget'] = $arrayResult['dateBudget'];
				$arrayMail['expirationDate'] = $arrayResult['expirationDate'];
				$arrayMail['mailPromoter'] = $_POST['emailPromoter'];			
				$arrayMail['namePromoter'] = $_POST['namePromoter'] . ' ' . $_POST['namePromoter'];
				$arrayMail['phonePromoter'] = $_POST['cellPromoter'];
				
				$idBudget = $arrayResult['id'];
				
				$result = $iteme->add($idBudget, $itemesBudget);

				$result = $user->mailBudget($arrayMail);
				
				$result = $diarypatient->addAutomatic($idBudget);
			
				if ($result == 0)
				{
					if ($this->Auth->user('username'))
					{
						$this->Flash->success(__('El presupuesto se creo exitosamente'));
					}
					else
					{
						$this->Flash->success(__('Los datos se guardaron correctamente, por favor escriba su usuario, la contraseña y pulsa el botón ACCEDER'));
						return $this->redirect(['action' => 'login']);                      
					}
				}
				else
				{
					$this->Flash->error(__('No se pudo crear la agenda del paciente'));
				}
			}
			else
			{
				$this->Flash->error(__('No se pudieron registrar los datos del presupuesto solicitado'));
			}
		
            if (isset($_POST['controller']))
            {
                $controller = $_POST['controller'];
                $action = $_POST['action'];
            }
            if ($controller == 'Users' && $action == 'viewGlobal')  
			{
				return $this->redirect(['controller' => $controller, 'action' => $action, $_POST['idUser'], 'Users', 'indexPatientUser']);
			}
			elseif ($controller == 'Diarypatients' && $action == 'index')  
			{
				return $this->redirect(['controller' => $controller, 'action' => $action]);
			}
        }           
    }
    public function multilevel()
    {
        $this->loadModel('Users');

        if ($this->request->is('post'))
        {
            $father = $_POST['father'];

            $promoter = $_POST['promoter'];

            $user = $this->Users->get($father);

            $rolePromoter = $user->role;
        }
        else
        {
            $father = $this->Auth->user('id');
            $promoter = $this->Auth->user('surname') . ' ' . $this->Auth->user('second_surname') . ' ' . 
                $this->Auth->user('first_name') . ' '. $this->Auth->user('second_name') . ' - ' . $this->Auth->user('role');

            $rolePromoter = $this->Auth->user('role');     
        }
            
        $budgets = TableRegistry::get('Budgets');

        $budgetsG = $budgets->find()
            ->select(
            ['Budgets.id',
            'Budgets.number_budget', 
            'Budgets.surgery', 
            'Budgets.number_bill', 
            'Budgets.amount_bill', 
            'Patients.id',
            'Users.id',
            'Users.parent_user', 
            'Users.first_name', 
            'Users.second_name',
            'Users.surname',
            'Users.second_surname',
            'Users.role'])
            ->contain(['Patients' => ['Users']])
            ->where(['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]])
            ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC', 'Budgets.application_date' => 'DESC']);

        $users = TableRegistry::get('Users');

        $children = $users->find()
            ->select(
            ['Users.id',
            'Users.parent_user',
            'Users.first_name', 
            'Users.second_name',
            'Users.surname',
            'Users.second_surname'])
            ->where([['Users.parent_user' => $father], ['Users.role' => 'Promotor(a) independiente'], ['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]])
            ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC']);

        $grandchildren = $users->find()
            ->select(
            ['Users.id',
            'Users.parent_user',
            'Users.first_name', 
            'Users.second_name',
            'Users.surname',
            'Users.second_surname'])
            ->where([['Users.role' => 'Promotor(a) independiente'], ['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]])
            ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC']);


        $currentView = 'multilevel';

        $this->set(compact('promoter', 'father', 'rolePromoter', 'budgetsG', 'children', 'grandchildren', 'currentView'));
        $this->set('_serialize', ['promoter', 'father', 'rolePromoter', 'budgetsG', 'children', 'grandchildren', 'currentView']);
    }
    public function bill($idBudget = null, $surgery = null)
    {
        if ($this->request->is('post')) 
        {      
            if (isset($_POST['idBudget']))
            {		
				$idBudget = $_POST['idBudget'];
				
				$surgery = $_POST['surgery']; 
            }
            else
            {
                $budget = $this->Budgets->get($_POST['id']);

                $budget = $this->Budgets->patchEntity($budget, $this->request->data);
                if ($this->Budgets->save($budget)) 
                {
                    $this->Flash->success(__('La factura fue guardada exitosamente'));
                    return $this->redirect(['controller' => 'budgets', 'action' => 'bill']);
                }
                else
                {
                    $this->Flash->error(__('La factura no pudo ser guardada'));
					return $this->redirect(['controller' => 'budgets', 'action' => 'bill'], $budget->id, $budget->surgery);
                }
            }
        }
		if (isset($idBudget))
		{	
			$budgets = TableRegistry::get('Budgets');
	
			$arrayResult = $budgets->find('budget', ['id' => $idBudget]);
	
			if ($arrayResult['indicator'] == 0)
			{
				$budgetQuery = $arrayResult['searchRequired'];
			}
			else
			{
				$this->Flash->error(__('No se encontró el presupuesto'));
			}
		
			$promoter = $this->Budgets->Patients->Users->get($budgetQuery->patient->user->parent_user);
						
			$budget = $this->Budgets->get($idBudget);

			$currentView = 'bill';

			$this->set(compact('currentView', 'surgery', 'budget', 'budgetQuery', 'promoter'));
			$this->set('_serialize', ['currentView', 'surgery', 'budget', 'budgetQuery', 'promoter']);	
		}
		else
		{		
            $currentView = 'bill';

            $this->set(compact('currentView'));
            $this->set('_serialize', ['currentView']);           
        }
    }
    public function findBudget()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            
            $name = $this->request->query['term'];
            $results = $this->Budgets->find('all', [
                'conditions' => ['Budgets.number_budget LIKE' => $name . '%']]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['number_budget'] . ' - ' . $result['surgery'], 'value' => $result['number_budget'] . ' - ' . $result['surgery'], 'id' => $result['id']];
            }

            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }
}
<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\UsersController;

use App\Controller\ServicesController;

use App\Controller\ItemesController;

use App\Controller\DiarypatientsController;

use App\Controller\CommissionsController;

use App\Controller\BinnaclesController;

use App\Controller\SystemsController;

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
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Administrador(a) de la clínica' )
            {
                if(in_array($this->request->action, ['edit', 'view', 'budget', 'multilevel', 'addBudget', 'restore', 'delete', 'mainBudget', 'bill', 'findBudget']))
                {
                    return true;
                }
            }
            elseif ($user['role'] === 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['edit', 'view', 'budget', 'multilevel', 'addBudget', 'restore', 'delete', 'mainBudget']))
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
		$budget = $this->Budgets->get(1737);
		
		$this->Flash->success(__('coin: ' . $budget->coin));
		$this->Flash->success(__('coin_bill: ' . $budget->coin_bill));
		
		$budget->coin_bill = 'PRUEBA';
		
		if ($this->Budgets->save($budget)) 
		{
			$this->Flash->success(__('El presupuesto se actualizó'));
		}
		else
		{
			$this->Flash->error(__('El presupuesto no se actualizó'));
		}
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
		
		$budget->activity_result = "Verificar correo y teléfonos del paciente y confirmar presupuesto";
		
		$budget->detailed_result_activity = 'Sin detalles';

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
            
            $budget->activity_result = "Verificar correo y teléfonos del paciente y confirmar presupuesto";
            
            $budget->detailed_result_activity = 'Sin detalles';

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
    public function delete($id = null, $controller = null, $action = null, $idUser = null, $idPromoter = null)
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
			if ($result == 0)
			{
				$this->Flash->success(__('El presupuesto fue eliminado exitosamente'));
			}
			else
			{
				$this->Flash->error(__('No se pudo eliminar el presupuesto'));
			}
		
			if ($controller == 'Users' && $action == 'viewGlobal')
			{ 
				return $this->redirect(['controller' => $controller, 'action' => $action, $idUser, 'Users', 'indexPatientUser', $idPromoter]);
			}
			else
			{
				return $this->redirect(['controller' => $controller, 'action' => $action, $idUser]);	
			}
        }
		else
		{
			return $result;
		}
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

    public function budget($id = null, $idUser = null, $idPatient = null, $idPromoter = null, $controller = null, $action = null, $idBudget = null, $previousSurgery = null)
    {   
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
    
        $patient = $this->Budgets->Patients->get($idPatient);
		
		$user = $this->Budgets->Patients->Users->get($idUser);
		
		$promoter = $this->Budgets->Patients->Users->get($user->parent_user);
		
		$this->loadModel('Services');		
		
		$services = $this->Services->find('list', ['limit' => 1000, 'conditions' => [['Services.registration_status' => 'ACTIVO'], ['OR' => [['Services.cost_bolivars >' => 0], ['Services.cost_dollars >' => 0]]]], 'order' => ['Services.service_description' => 'ASC']]);

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
		
        $this->set(compact('system', 'patient', 'user', 'promoter', 'controller', 'action', 'services', 'idBudget', 'previousSurgery', 'idPromoter', 'budget' , 'itemes'));
        $this->set('_serialize', ['system', 'patient', 'user', 'promoter', 'controller', 'action', 'services', 'idBudget', 'previousSurgery', 'idPromoter', 'budget' , 'itemes']);
    }
	
/* Borrar al terminar el cambio
    public function view($namePatient = null, $namePromoter = null, $cellPromoter = null, $emailPromoter = null, $controller = null, $action = null, $idUser = null, $idPromoter = null)
    {

        $this->set('budget', $budget);
        $this->set('_serialize', ['budget']);
        $this->set(compact('namePatient', 'namePromoter', 'cellPromoter', 'emailPromoter', 'controller', 'action', 'itemes', 'idUser', 'idPromoter'));
    } */
	
    public function correo()
    {
        $email = new Email('default');
            $email->from(['noresponder@cirugiaslanacional.com' => 'Cirugías La Nacional'])
            ->to('transemainc@gmail.com')
            ->subject('Presupuesto solicitado')
            ->send('Presupuesto');
    }
    public function addBudget()
    {       
        $this->autoRender = false;
		
		$arrayMail = [];

        if ($this->request->is('post'))
        {
			$user = new UsersController;
			
			$service = new ServicesController;
			
			$iteme = new ItemesController;
			
            $diarypatient = new DiarypatientsController;
			
			if (isset($_POST['idBudget']))
			{
				$result = $this->delete($_POST['idBudget']);
			}
			else
			{
				$result = 0;
			}
			
			if ($result == 0)
			{
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
					
					$result = $diarypatient->addAutomatic($idBudget);
									
					if ($result == 0)
					{
						$result = $user->mailBudget($arrayMail);

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
			}
			else
			{
				$this->Flash->error(__('No se pudo enviar el presupuesto'));
			}
		
            if (isset($_POST['controller']))
            {
                $controller = $_POST['controller'];
                $action = $_POST['action'];
            }
            if ($controller == 'Users' && $action == 'viewGlobal')  
			{
				return $this->redirect(['controller' => $controller, 'action' => $action, $_POST['idUser'], 'Users', 'indexPatientUser', $_POST['idPromoter']]);
			}
			elseif ($controller == 'Diarypatients' && $action == 'index')  
			{
				return $this->redirect(['controller' => $controller, 'action' => $action]);
			}
			elseif ($controller == 'Budgets' && $action == 'mainBudget')  
			{
				return $this->redirect(['controller' => $controller, 'action' => $action, $arrayResult['id']]);
			}
        }           
    }
    public function multilevel()
    {
        $this->loadModel('Users');
		
		$this->loadModel('Commissions');

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
			'Budgets.coin',
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
            ->where([['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]],
				['OR' => ['Budgets.deleted_record IS NULL', 'Budgets.deleted_record' => false]]])
            ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC', 'Budgets.application_date' => 'DESC']);

        $commissions = TableRegistry::get('Commissions');

        $vCommissions = $commissions->find()
            ->where([['Commissions.registration_status' => 'ACTIVO'], ['Commissions.status_commission' => 'PENDIENTE DE PAGO']]);

		$arrayCommissions = [];
		
		foreach ($vCommissions as $vCommission)
		{
			$keyArray = 'u' . $vCommission->user_id . 'b' . $vCommission->budget_id;
			$arrayCommissions[$keyArray] = $vCommission->amount;
		}	
			
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

        $this->set(compact('promoter', 'father', 'rolePromoter', 'budgetsG', 'children', 'grandchildren', 'currentView', 'arrayCommissions'));
        $this->set('_serialize', ['promoter', 'father', 'rolePromoter', 'budgetsG', 'children', 'grandchildren', 'currentView', 'arrayCommissions']);
    }
    public function bill($idBudget = null, $budgetSurgery = null)
    {
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
				
		$commissions = new CommissionsController;
		
		$binnacles = new BinnaclesController;
	
		if ($this->request->is(['patch', 'post', 'put']))
        {      
            if (isset($_POST['idBudget']))
            {			
				$idBudget = $_POST['idBudget'];
				
				$budgetSurgery = $_POST['budgetSurgery']; 
				
				if (isset($_POST['swDelete']))
				{				
					$budget = $this->Budgets->get($idBudget);

					$budget->date_bill = null;
					$budget->number_bill = null;				
					$budget->amount_bill = null;
					$budget->bill = null;
					$budget->bill_dir = null;
					
					$arrayResult = $commissions->add($_POST['promoter'], $budget->id, $budget->amount_bill, $budget->coin, 1);
										
					if ($arrayResult['indicator'] == 0)
					{
						if ($this->Budgets->save($budget)) 
						{
							$this->Flash->success(__('La factura fue eliminada exitosamente'));
							return $this->redirect(['controller' => 'budgets', 'action' => 'bill', $idBudget, $budgetSurgery]);
						}
						else
						{
							$this->Flash->error(__('La factura no pudo ser eliminada'));
							return $this->redirect(['controller' => 'budgets', 'action' => 'bill', $idBudget, $budgetSurgery]);
						}
					}
					else
					{
					    $this->Flash->error(__("La comisión no pudo ser eliminada debido a: " . implode(" - ", $arrayResult['arrayError'])));

						foreach($arrayResult['arrayError'] as $noveltys)
						{
							$binnacles->add('controller', 'Commissions', 'add', $noveltys);
						}
						return $this->redirect(['controller' => 'budgets', 'action' => 'bill', $idBudget, $budgetSurgery]);
					}
				}
            }
            else
            {			
                $budget = $this->Budgets->get($_POST['id']);
				
				$budgetSurgery = $budget->number_budget . ' - ' . $budget->surgery;

                $budget = $this->Budgets->patchEntity($budget, $this->request->data);
										
				$arrayResult = $commissions->add($budget->extra_column1, $budget->id, $budget->amount_bill, $budget->coin, 0);
				
				if ($arrayResult['indicator'] == 0)
				{				
					$budget->extra_column1 = null;
					
					if ($this->Budgets->save($budget)) 
					{
						$this->Flash->success(__('La factura fue guardada exitosamente'));
						return $this->redirect(['controller' => 'budgets', 'action' => 'bill', $budget->id, $budgetSurgery]);
					}
					else
					{
						$this->Flash->error(__('La factura no pudo ser guardada'));
						return $this->redirect(['controller' => 'budgets', 'action' => 'bill', $budget->id, $budgetSurgery]);
					}
				}
				else
				{
					$this->Flash->error(__("La comisión no pudo ser grabada debido a: " . implode(" - ", $arrayResult['arrayError'])));

					foreach($arrayResult['arrayError'] as $noveltys)
					{
						$binnacles->add('controller', 'Commissions', 'add', $noveltys);
					}
					return $this->redirect(['controller' => 'budgets', 'action' => 'bill', $budget->id, $budgetSurgery]);
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

			$this->set(compact('system', 'currentView', 'budgetSurgery', 'budget', 'budgetQuery', 'promoter'));
			$this->set('_serialize', ['system', 'currentView', 'budgetSurgery', 'budget', 'budgetQuery', 'promoter']);	
		}
		else
		{
            $currentView = 'bill';

            $this->set(compact('system', 'currentView'));
            $this->set('_serialize', ['system', 'currentView']);           
        }
    }
    public function findBudget()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            
            $name = $this->request->query['term'];
            $results = $this->Budgets->find('all', [
                'conditions' => 
					[['Budgets.number_budget LIKE' => $name . '%'],
					['OR' => ['Budgets.deleted_record IS NULL', 'Budgets.deleted_record' => false]]]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['number_budget'] . ' - ' . $result['surgery'], 'value' => $result['number_budget'] . ' - ' . $result['surgery'], 'id' => $result['id']];
            }

            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }
	public function mainBudget($idBudget = null)
	{
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
		
		$currentView = 'mainBudget';
		
		if ($this->request->is(['patch', 'post', 'put']))
        {      
            if (isset($_POST['idBudget']))
            {		
				$idBudget = $_POST['idBudget'];
			}
		}
		
		if (isset($idBudget))
		{
			$budget = $this->Budgets->get($idBudget, 
				['contain' => ['Patients' => ['Users']]]);
									
			$promoter = $this->Budgets->Patients->Users->get($budget->patient->user->parent_user);
			
			return $this->redirect(['controller' => 'Budgets', 'action' => 'view',
				$idBudget,
				$budget->patient->user->full_name,
				$promoter->full_name,
				$promoter->cell_phone,
				$promoter->email,
				'Budgets',
				'mainBudget',
				$budget->patient->user->id,
				$promoter->id]);				
		}

        $this->set(compact('system', 'currentView'));
        $this->set('_serialize', ['system', 'currentView']); 
	}
}
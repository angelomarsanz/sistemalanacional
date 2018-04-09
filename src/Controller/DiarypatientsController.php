<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

use App\Controller\BinnaclesController;

use App\Controller\SystemsController;

use Cake\I18n\Time;

/**
 * Diarypatients Controller
 *
 * @property \App\Model\Table\DiarypatientsTable $Diarypatients
 */
class DiarypatientsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['addWebDiary', 'restore']);
    }
    
    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Administrador(a) de la clínica' )
            {
                if(in_array($this->request->action, ['index', 'edit', 'indexMonth', 'restore', 'reasign', 'reportDiary', 'markColumns']))
                {
                    return true;
                }
            }
            elseif ($user['role'] === 'Coordinador(a)')
            {
                if(in_array($this->request->action, ['index', 'edit', 'indexMonth', 'restore', 'reasign']))
                {
                    return true;
                }
            }			
            elseif ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['index', 'edit', 'indexMonth', 'restore']))
                {
                    return true;
                }                
            }
            elseif ($user['role'] === 'Call center')
            {
                if(in_array($this->request->action, ['index', 'edit', 'indexMonth', 'restore']))
                {
                    return true;
                }                
            }

        }
        return parent::isAuthorized($user);
    }  

	public function testFunction()
	{
		$pruebaHora = new Time();
		
		debug($pruebaHora);
		
		$pruebaHora
			->year(1971)
			->month(03)
			->day(27)
			->hour(23)
			->minute(59)
			->second(59);
			
		debug($pruebaHora);
	}
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
	
        $diarypatients = TableRegistry::get('Diarypatients');
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = time::now();
        
        $currentDate->hour(23)
            ->minute(59)
            ->second(59);

        if ($this->request->is('post'))
		{
			$arrayResult = $diarypatients->find('diary', ['conditions' => 
				[['Diarypatients.activity_date <=' => $currentDate],
				['Diarypatients.id >' => 1],
				['OR' => ['Diarypatients.status IS NULL', 'Diarypatients.status' => false]],
				['OR' => ['Diarypatients.deleted_record IS NULL', 'Diarypatients.deleted_record' => false]],
				['OR' => ['Budgets.deleted_record IS NULL', 'Budgets.deleted_record' => false]],
				['Budgets.activity_result !=' => 'Cerrado'],
				['Users.parent_user' => $_POST['idPromoter']]]]);
			$namePromoter = $_POST['namePromoter'];
		}
		else
		{	
			$arrayResult = $diarypatients->find('diary', ['conditions' => 
				[['Diarypatients.activity_date <=' => $currentDate],
				['Diarypatients.id >' => 1],
				['OR' => ['Diarypatients.status IS NULL', 'Diarypatients.status' => false]],
				['OR' => ['Diarypatients.deleted_record IS NULL', 'Diarypatients.deleted_record' => false]],
				['OR' => ['Budgets.deleted_record IS NULL', 'Budgets.deleted_record' => false]],
				['Budgets.activity_result !=' => 'Cerrado']]]);	
			$namePromoter = 'General';
		}
				
		if ($arrayResult['indicator'] == 0)
		{
			$diary = $arrayResult['searchRequired'];
			
			$promoter = [];

			foreach ($diary as $diarys)
			{
				$idPromoter = $diarys->budget->patient->user->parent_user;
				
				$userPromoter = $this->Diarypatients->Budgets->Patients->Users->get($idPromoter);
				
				$promoter[$diarys->id]['namePromoter'] = $userPromoter->full_name;

				$promoter[$diarys->id]['cellPromoter'] = $userPromoter->cell_phone;

				$promoter[$diarys->id]['emailPromoter'] = $userPromoter->email;

				$diferent = $diarys->activity_date->diff($currentDate)->d;
	 
				if ($diferent > 0)
				{
					$promoter[$diarys->id]['observationPromoter'] = "Atraso";
				}
				else
				{
					$promoter[$diarys->id]['observationPromoter'] = "Pendiente";
				}
			}						
		}
		else
		{
			$this->Flash->error(__('No se encontraron actividades'));
			return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
		}
		       
		$currentView = 'DiarypatientsIndex';
		       
        $this->set(compact('system', 'diary', 'currentDate', 'promoter', 'currentView', 'namePromoter'));
        $this->set('_serialize', ['system', 'diary', 'currentDate', 'promoter', 'currentView', 'namePromoter']);
    }
    public function indexMonth()
    {
        $diarypatients = TableRegistry::get('Diarypatients');
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = time::now();
        
        $currentDate->hour(23)
            ->minute(59)
            ->second(59);
            
        $diary = $diarypatients->find()
            ->select(
            ['Diarypatients.id',
            'Diarypatients.activity_date', 
            'Diarypatients.short_description_activity', 
            'Budgets.surgery', 
			'Budgets.activity_result',
			'Budgets.deleted_record',
            'Patients.landline',
            'Users.id',
            'Users.parent_user', 
            'Users.first_name', 
            'Users.second_name', 
            'Users.surname', 
            'Users.second_surname',
            'Users.cell_phone',
            'Users.email'])
            ->contain(['Budgets' => ['Patients' => ['Users']]])
            ->where([['Diarypatients.activity_date >' => $currentDate],
				['Diarypatients.id >' => 1],
				['OR' => ['Diarypatients.status IS NULL', 'Diarypatients.status' => false]],
				['OR' => ['Diarypatients.deleted_record IS NULL', 'Diarypatients.deleted_record' => false]],
				['OR' => ['Budgets.deleted_record IS NULL', 'Budgets.deleted_record' => false]],
				['Budgets.activity_result !=' => 'Cerrado']])
            ->order(['Diarypatients.activity_date' => 'DESC']);

        $promoter = [];

        foreach ($diary as $diarys)
        {
            $idPromoter = $diarys->budget->patient->user->parent_user;
            
            $userPromoter = $this->Diarypatients->Budgets->Patients->Users->get($idPromoter);
            
            $promoter[$diarys->id]['namePromoter'] = $userPromoter->full_name;
            
            $promoter[$diarys->id]['cellPromoter'] = $userPromoter->cell_phone;
        }
    
        $this->set('diary', $this->paginate($diary));

        $this->set(compact('diary', 'currentDate', 'promoter'));
        $this->set('_serialize', ['diary', 'currentDate', 'promoter']);
    }

    /**
     * View method
     *
     * @param string|null $id Diarypatient id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diarypatient = $this->Diarypatients->get($id, [
            'contain' => []
        ]);

        $this->set('diarypatient', $diarypatient);
        $this->set('_serialize', ['diarypatient']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diarypatient = $this->Diarypatients->newEntity();
        if ($this->request->is('post')) {
            $diarypatient = $this->Diarypatients->patchEntity($diarypatient, $this->request->data);
            if ($this->Diarypatients->save($diarypatient)) {
                $this->Flash->success(__('The diarypatient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diarypatient could not be saved. Please, try again.'));
        }
        $this->set(compact('diarypatient'));
        $this->set('_serialize', ['diarypatient']);
    }
    public function addAutomatic($idBudget = null)
    {
        $this->autoRender = false;
        
        $diarypatient = $this->Diarypatients->newEntity();
        
        $diarypatient->budget_id = $idBudget;
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = Time::now();
        
        $currentDate->hour(23)
            ->minute(59)
            ->second(59);
            
        $currentDateProx = $currentDate;

        $diarypatient->activity_date = $currentDate;  
        
        $diarypatient->short_description_activity = "Verificar correo y teléfonos del paciente y confirmar presupuesto";
        
        $diarypatient->detailed_activity_description = "Sin detalles";
        
        $diarypatient->activity_comments = "";
        
        $diarypatient->activity_date_next = $currentDateProx;  
        
        $diarypatient->activity_next = "";
        
        $diarypatient->detailed_next_activity = "";        
        
        if ($this->Auth->user('username'))
        {
            $diarypatient->responsible_user = $this->Auth->user('username');
        }

        if ($this->Diarypatients->save($diarypatient)) 
        {
            $result = 0;    
        }       
        else
        {
            $result = 1;
        }

        return $result;
    }
    
    public function addWebDiary($idBudget = null)
    {
        $this->autoRender = false;
        
        $diarypatient = $this->Diarypatients->newEntity();
        
        $diarypatient->budget_id = $idBudget;
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = Time::now();
        
        $currentDate->hour(23)
            ->minute(59)
            ->second(59);
            
        $currentDateProx = $currentDate;

        $diarypatient->activity_date = $currentDate;  
        
        $diarypatient->short_description_activity = "Verificar correo y teléfonos del paciente y confirmar presupuesto";
        
        $diarypatient->detailed_activity_description = "Sin detalles";
        
        $diarypatient->activity_comments = "";
        
        $diarypatient->activity_date_next = $currentDateProx;  
        
        $diarypatient->activity_next = "";
        
        $diarypatient->detailed_next_activity = "";        
        
        $diarypatient->responsible_user = 'clnacional2017';

        if ($this->Diarypatients->save($diarypatient)) 
        {
            $result = 0;    
        }
        else
        {
            $result = 1;
        }

        return $result;
    }

    public function sendBudget($id = null)
    {
        $this->autoRender = false;
        
        $diarypatient = $this->Diarypatients->get($id);
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = Time::now();
        
        $currentDate->hour(23)
            ->minute(59)
            ->second(59);
            
        $currentDateProx = $currentDate;

        $diarypatient->activity_comments = "Sin detalles";
        
        $diarypatient->activity_date_next = $currentDateProx;  
        
        $diarypatient->activity_next = "Verificar correo y teléfonos del paciente y confirmar presupuesto";
        
        $diarypatient->detailed_next_activity = "Sin detalles";        
        
        $diarypatient->status = true;
        
        if ($this->Auth->user('username'))
        {
            $diarypatient->responsible_user = $this->Auth->user('username');
        }

        if ($this->Diarypatients->save($diarypatient)) 
        {
            $diarypatientProx = $this->Diarypatients->newEntity();
            
            $diarypatientProx->budget_id = $diarypatient->budget_id;
            
            $diarypatientProx->activity_date = $currentDateProx;
            
            $diarypatientProx->short_description_activity = $diarypatient->activity_next;
            
            $diarypatientProx->detailed_activity_description = $diarypatient->detailed_next_activity;
            
            $diarypatientProx->activity_comments = "";

            $diarypatientProx->activity_date_next = $currentDateProx;  
            
            $diarypatientProx->activity_next = "";
            
            $diarypatientProx->detailed_next_activity = ""; 
            
            if ($this->Auth->user('username'))
            {
                $diarypatientProx->responsible_user = $this->Auth->user('username');
            }

            if ($this->Diarypatients->save($diarypatientProx)) 
            {
                $result = 1;    
            }       
            else
            {
                $result = 0;
            }
        }
        else
        {
            $result = 0;
        }

        return $result;
    }

    /**
     * Edit method
     *
     * @param string|null $id Diarypatient id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $promoter = null, $origin = null)
    {
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
		date_default_timezone_set('America/Caracas');
		
		$currentDate = time::now();
						
        $diarypatient = $this->Diarypatients->get($id, [
            'contain' => ['Budgets' => ['Patients' => ['Users']]]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $diarypatient = $this->Diarypatients->patchEntity($diarypatient, $this->request->data);
													
			$tmpTime = new Time();
			
			$tmpTime
				->year($diarypatient->activity_date_next->year)
				->month($diarypatient->activity_date_next->month)
				->day($diarypatient->activity_date_next->day)
				->hour(23)
				->minute(59)
				->second(59);
							
			$diarypatient->activity_date_next = $tmpTime;
			
            $diarypatient->status = true;
			
            if ($this->Diarypatients->save($diarypatient)) 
            {
				$budget = $this->Diarypatients->Budgets->get($diarypatient->budget_id);

				if ($diarypatient->activity_next == 'Cerrar (el paciente ya no está interesado)' ||
					$diarypatient->activity_next == 'Cerrar (ya se practicó la cirugía o se ejecutó el servicio)')
				{					
					$this->Flash->success(__('La actividad se cerró exitosamente'));
					
					$budget->activity_date_finish = $currentDate;
				
					$budget->activity_result = 'Cerrado';

					if ($diarypatient->activity_next == 'Cerrar (el paciente ya no está interesado)')
					{
						$budget->detailed_result_activity = 'El paciente ya no está interesado';
					}
					else
					{
						$budget->detailed_result_activity = 'Ya se practicó la cirugía o se ejecutó el servicio';
					} 					
				}
				else
				{	
					$diarypatientProx = $this->Diarypatients->newEntity();
					
					$diarypatientProx->budget_id = $diarypatient->budget_id; 

					$diarypatientProx->activity_date = $diarypatient->activity_date_next;
					
					$diarypatientProx->short_description_activity = $diarypatient->activity_next;
					
					$diarypatientProx->detailed_activity_description = $diarypatient->detail_next_activity;
					
					$diarypatientProx->activity_comments = "";
												
					$currentDate->hour(23)
						->minute(59)
						->second(59);
						
					$currentDateProx = $currentDate;
					
					$diarypatientProx->activity_date_next = $currentDateProx;  
					
					$diarypatientProx->activity_next = "";
					
					$diarypatientProx->detailed_next_activity = "";                 
					
					if ($this->Diarypatients->save($diarypatientProx)) 
					{
						$this->Flash->success(__('La actividad se cerró exitosamente'));							
					}
					else
					{
						$this->Flash->error(__('No se pudo cerrar la actividad'));
					}
					
					$budget->activity_date_finish = $diarypatient->activity_date_next;
					
					$budget->activity_result = $diarypatient->activity_next;
					
					$budget->detailed_result_activity = $diarypatient->detail_next_activity;
				}
				if ($this->Diarypatients->Budgets->save($budget))
				{
					$this->Flash->success(__('El presupuesto se actualizó exitosamente'));
				}
				else
				{
					$this->Flash->error(__('No se pudo actualizar el presupuesto'));
				}
            }
            else
            {
                $this->Flash->error(__('No se pudo cerrar la actividad'));    
            }
            return $this->redirect(['action' => $origin]); 
        }
		
        $this->set(compact('diarypatient', 'origin', 'promoter'));
        $this->set('_serialize', ['diarypatient', 'origin', 'promoter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Diarypatient id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diarypatient = $this->Diarypatients->get($id);
        
        $diarypatient->deleted_record = true;
        
        $result = 0;
        
        if ($this->Diarypatients->save($diarypatient)) 
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
        $this->autoRender = false;
        
        $diarypatient = $this->Diarypatients->get($id);
        
        $diarypatient->deleted_record = null;
        
        $result = 0;
        
        if ($this->Diarypatients->save($diarypatient)) 
        {
            $result = 0;
        }
        else 
        {
            $result = 1;
        }

        return $result;
    }
    public function reasign($idPatient = null, $origin = null)
    {
        $this->set(compact('idPatient', 'origin'));
    }
	
	public function EliminateRedundantActivities()
	{	
		$this->adjustClosedBudgets(); 
			
		$this->budgetsWithoutActivity();
			
		$this->closedActivities();	

		$this->updateBudgets();	
	}	
	
	public function adjustClosedBudgets()
	{					
		$closedBudgets = $this->Diarypatients->find('all')
			->contain(['Budgets'])
			->where([['Diarypatients.id >' => 1],
			['Diarypatients.status IS NULL'],
            ['Budgets.activity_result' => 'Cerrado']])
			->order(['Diarypatients.id' => 'ASC']);
			
		$accountClosed = $closedBudgets->count();  

		$this->Flash->success(__('Total presupuestos cerrados que aún tienen actividades abiertas: ' . $accountClosed));
		
		$accountUpdate = 0;
		
		foreach ($closedBudgets as $closedBudget)
		{
			$diarypatient = $this->Diarypatients->get($closedBudget->id);
			
			$diarypatient->status = true;
			
            if ($this->Diarypatients->save($diarypatient)) 
            {
				$accountUpdate++;
			}
			else
			{
				$this->Flash->error(__('No se pudo actualizar la actividad identificada como: ' . $closedBudgets->id));
			}
		}
		$this->Flash->success(__('Total actividades cerradas: ' . $accountUpdate));
		
		unset($closedBudgets, $closedBudget);
		
		return;
	}
	public function budgetsWithoutActivity()
	{
		$binnacles = new BinnaclesController;
	
		$openBudgets = $this->Diarypatients->Budgets->find('all')
			->where([['Budgets.id >' => 1],
            ['OR' => ['Budgets.activity_result IS NULL', 'Budgets.activity_result !=' => 'Cerrado']]])
			->order(['Budgets.id' => 'ASC']); 
			
		$accountOpen = $openBudgets->count();
				
		$accountWithActivity = 0;
		$accountWithoutActivity = 0;
		
		foreach ($openBudgets as $openBudget)
		{
			$lastRecord = $this->Diarypatients->find('all')
				->where(['Diarypatients.budget_id' => $openBudget->id])
				->order(['Diarypatients.created' => 'DESC']);
							
			$row = $lastRecord->first();

			if ($row)
			{
				$accountWithActivity++;
			}
			else	
			{
				$accountWithoutActivity++;
								
				$diarypatient = $this->Diarypatients->newEntity();
        
				$diarypatient->budget_id = $openBudget->id;
				
				setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
				date_default_timezone_set('America/Caracas');

				$currentDate = Time::now();
											
				$currentDate->year($openBudget->created->year)
					->month($openBudget->created->month)
					->day($openBudget->created->day)
					->hour(23)
					->minute(59)
					->second(59);
										
				$currentDateProx = $currentDate;

				$diarypatient->activity_date = $currentDate;
				
				$diarypatient->short_description_activity = "Verificar correo y teléfonos del paciente y confirmar presupuesto";
				
				$diarypatient->detailed_activity_description = "Sin detalles";
				
				$diarypatient->activity_comments = "";
				
				$diarypatient->activity_date_next = $currentDateProx;  
				
				$diarypatient->activity_next = "";
				
				$diarypatient->detailed_next_activity = "";        
				
				$diarypatient->responsible_user = 'clnacional2017';

				if ($this->Diarypatients->save($diarypatient)) 
				{
					$binnacles->add('controller', 'Diarypatients', 'budgetsWithoutActivity', 'Se creó actividad a presupuesto que no tenía. id: ' . $openBudget->id);
				}
			}
		}
				
		unset($openBudgets, $openBudget);
		
		return;
	}
	public function closedActivities()
	{		
		$verifyActivities = $this->Diarypatients->find('all')
			->contain(['Budgets'])
			->where([['Diarypatients.id >' => 1],
			['Diarypatients.status IS NULL'],
            ['OR' => ['Budgets.activity_result IS NULL', 'Budgets.activity_result !=' => 'Cerrado']]])
			->order(['Diarypatients.budget_id' => 'ASC', 'Diarypatients.activity_date' => 'DESC']); 
			
		$accountVerify = $verifyActivities->count();  

		$this->Flash->success(__('Total actividades abiertas de presupuestos activos: ' . $accountVerify));	
		
		$accountRecords = 0;
		$previousBudget = 0;
		$accountActivities = 0;
		$accountNotClosed = 0;
		$accountClosed = 0;
		foreach ($verifyActivities as $verifyActivity)
		{			
			if ($accountRecords == 0)
			{
				$previousBudget = $verifyActivity->budget_id;
			}
			$accountRecords++;
			if ($previousBudget != $verifyActivity->budget_id)
			{
				$previousBudget = $verifyActivity->budget_id;
				$accountActivities = 0;
			}
			$accountActivities++;
								
			if ($accountActivities == 1)
			{
				$accountNotClosed++;
			}
			else
			{
				$diarypatient = $this->Diarypatients->get($verifyActivity->id);
							
				$diarypatient->status = true;
					
				if ($this->Diarypatients->save($diarypatient)) 
				{
					$accountClosed++;	
				}
				else
				{
					$this->Flash->error(__('No se pudo cerrar la actividad identificada como: ' . $verifyActivity->id));
				}
			}
		}
		$this->Flash->success(__('Total actividades no cerradas: ' . $accountNotClosed));
		$this->Flash->success(__('Total actividades cerradas: ' . $accountClosed));
		
		unset($verifyActivities, $verifyActivitie); 
		
		return; 
	}
	public function updateBudgets()
	{
		$openActivities = $this->Diarypatients->find('all')
			->contain(['Budgets'])
			->where([['Diarypatients.id >' => 1],
			['Diarypatients.status IS NULL'],
            ['OR' => ['Budgets.activity_result IS NULL', 'Budgets.activity_result !=' => 'Cerrado']]])
			->order(['Diarypatients.budget_id' => 'ASC']);
			
		$accountOpen = $openActivities->count();  

		$this->Flash->success(__('Total actividades abiertas de presupuestos activos: ' . $accountOpen));
		
		$accountUpdate = 0;
		
		foreach ($openActivities as $openActivity)
		{
			$budget = $this->Diarypatients->Budgets->get($openActivity->budget_id);
								
			$budget->activity_date_finish = $openActivity->activity_date;
			
			$budget->activity_result = $openActivity->short_description_activity;
			
			$budget->detailed_result_activity = $openActivity->detailed_activity_description;
			
			if ($this->Diarypatients->Budgets->save($budget))
			{
				$accountUpdate++;
			}
			else
			{
				$this->Flash->error(__('No se pudo actualizar el presupuesto id: ' . $openActivity->budget_id));
			}
		}
		$this->Flash->success(__('Total presupuestos actualizados: ' . $accountUpdate));
		
		unset($openActivities, $openActivity);
		
		return;
	}
	public function reportDiary()
	{					
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
		
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');
		
        $currentDate = Time::now();
		
		$currentDate->hour(23)
		->minute(59)
		->second(59);
		
		$binnacles = new BinnaclesController;

	    if ($this->request->is('post')) 
        {		
			$this->budgetsWithoutActivity();

			if (isset($_POST['columnsReport']))
			{
				$columnsReport = $_POST['columnsReport'];
			}
			else
			{
				$columnsReport = [];
			}
			
			$arrayMark = $this->markColumns($columnsReport); 
						
			$diarypatients = TableRegistry::get('Diarypatients');
		
			$arrayResult = $diarypatients->find('report', ['conditions' => 
				[['Diarypatients.id >' => 1],
				['OR' => ['Diarypatients.deleted_record IS NULL', 'Diarypatients.deleted_record' => false]],
				['OR' => ['Diarypatients.status IS NULL', 
					'Diarypatients.status' => false, 
					'Diarypatients.activity_next' => 'Cerrar (ya se practicó la cirugía o se ejecutó el servicio)',
					'Diarypatients.activity_next' => 'Cerrar (el paciente ya no está interesado)'
					]]]]);
											
			if ($arrayResult['indicator'] == 0)
			{
				$diary = $arrayResult['searchRequired'];
				
				$accountBudgets = $diary->count();
						
				$additional = [];
				$counter = [];
				$counter['billedBudgets'] = 0;
				$counter['closedBudgets'] = 0;
				$counter['overdueBudgets'] = 0;
				$counter['currentBudgets'] = 0;
				$counter['notSend'] = 0;
				$counter['closedActivities'] = 0;
				$counter['pendingActivities'] = 0;
				$counter['delayedActivities'] = 0;
				$counter['bolivaresBudget'] = 0;
				$counter['AmountBolivares'] = 0;
				$counter['dollarsBudget'] = 0;
				$counter['AmountDollars'] = 0;

				foreach ($diary as $diarys)
				{
					$idPromoter = $diarys->budget->patient->user->parent_user;
					
					$userPromoter = $this->Diarypatients->Budgets->Patients->Users->get($idPromoter);
					
					$additional[$diarys->id]['namePromoter'] = $userPromoter->full_name;

					$additional[$diarys->id]['cellPromoter'] = $userPromoter->cell_phone;

					$additional[$diarys->id]['emailPromoter'] = $userPromoter->email;
					
					if ($diarys->budget->number_bill != null && $diarys->budget->amount_bill > 0)
					{
						$additional[$diarys->id]['budgetStatus'] = "Facturado";
						$counter['billedBudgets']++;
					}
					else
					{
						if ($diarys->budget->activity_result == 'Cerrado')
						{
								$additional[$diarys->id]['budgetStatus'] = "Cerrado";
								$counter['closedBudgets']++;
						}
						elseif ($diarys->budget->number_budget == null)
						{
							$additional[$diarys->id]['budgetStatus'] = "No enviado";
							$counter['notSend']++;							
						}
						else
						{
							$diferentBudget = $diarys->budget->application_date->diff($currentDate)->d;
	 
							if ($diferentBudget > 3)
							{
								$additional[$diarys->id]['budgetStatus'] = "Vencido";
								$counter['overdueBudgets']++;
							}
							else
							{
								$additional[$diarys->id]['budgetStatus'] = "Vigente";
								$counter['currentBudgets']++;
							}
						}
					}
					if ($diarys->budget->coin == 'BOLIVAR')
					{
						$counter['bolivaresBudget']++;
						$counter['AmountBolivares']+= $diarys->budget->amount_budget;
					}
					else
					{
						$counter['dollarsBudget']++;
						$counter['AmountDollars']+= $diarys->budget->amount_budget;
					}
					if ($diarys->activity_next == 'Cerrar (ya se practicó la cirugía o se ejecutó el servicio)' ||
						$diarys->activity_next == 'Cerrar (el paciente ya no está interesado)')
					{
						$additional[$diarys->id]['statusActivity'] = "Cerrada";
						$counter['closedActivities']++;
					}
					else
					{
						$diferent = $diarys->activity_date->diff($currentDate)->d;
			 
						if ($diferent > 0)
						{
							$additional[$diarys->id]['statusActivity'] = "Atrasada";
							$counter['delayedActivities']++;
							
						}
						else
						{
							$additional[$diarys->id]['statusActivity'] = "Pendiente";
							$counter['pendingActivities']++;
						}
					}
				}
			}
			else
			{
				$this->Flash->error(__('No se encontraron actividades'));
				return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
			}
			
			$swImpresion = 1;
							
			$this->set(compact('system', 'swImpresion', 'diary', 'additional', 'currentDate', 'counter', 'arrayMark'));
			$this->set('_serialize', ['system', 'swImpresion', 'diary', 'additional', 'currentDate', 'counter', 'arrayMark']); 
		}
		else
		{
			$swImpresion = 0;
			$this->set(compact('system', 'swImpresion'));
			$this->set('_serialize', ['system', 'swImpresion']); 
		} 
	}
	public function markColumns($columnsReport = null)
	{
		$arrayMark = [];
		
		isset($columnsReport['Users.full_name']) ? $arrayMark['Users.full_name'] = 'siExl' : $arrayMark['Users.full_name'] = 'noExl';
		isset($columnsReport['Users.cell_phone']) ? $arrayMark['Users.cell_phone'] = 'siExl' : $arrayMark['Users.cell_phone'] = 'noExl';
		isset($columnsReport['Users.email']) ? $arrayMark['Users.email'] = 'siExl' : $arrayMark['Users.email'] = 'noExl';
		isset($columnsReport['Budgets.coin']) ? $arrayMark['Budgets.coin'] = 'siExl' : $arrayMark['Budgets.coin'] = 'noExl';
		isset($columnsReport['Budgets.amount_budget']) ? $arrayMark['Budgets.amount_budget'] = 'siExl' : $arrayMark['Budgets.amount_budget'] = 'noExl';
		isset($columnsReport['Budgets.number_bill']) ? $arrayMark['Budgets.number_bill'] = 'siExl' : $arrayMark['Budgets.number_bill'] = 'noExl';
		isset($columnsReport['Budgets.amount_bill']) ? $arrayMark['Budgets.amount_bill'] = 'siExl' : $arrayMark['Budgets.amount_bill'] = 'noExl';
		isset($columnsReport['additional.namePromoter']) ? $arrayMark['additional.namePromoter'] = 'siExl' : $arrayMark['additional.namePromoter'] = 'noExl';
		isset($columnsReport['additional.cellPromoter']) ? $arrayMark['additional.cellPromoter'] = 'siExl' : $arrayMark['additional.cellPromoter'] = 'noExl';
		isset($columnsReport['additional.emailPromoter']) ? $arrayMark['additional.emailPromoter'] = 'siExl' : $arrayMark['additional.emailPromoter'] = 'noExl';
		isset($columnsReport['Diarys.short_description_activity']) ? $arrayMark['Diarys.short_description_activity'] = 'siExl' : $arrayMark['Diarys.short_description_activity'] = 'noExl';
		isset($columnsReport['Diarys.activity_date']) ? $arrayMark['Diarys.activity_date'] = 'siExl' : $arrayMark['Diarys.activity_date'] = 'noExl';
		isset($columnsReport['additional.statusActivity']) ? $arrayMark['additional.statusActivity'] = 'siExl' : $arrayMark['additional.statusActivity'] = 'noExl';
		
		return $arrayMark;
	}
}
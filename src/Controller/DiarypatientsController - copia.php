<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

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
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Coordinador(a)' )
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
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $diarypatients = TableRegistry::get('Diarypatients');
        
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = time::now();
        
        $currentDate->hour(23)
            ->minute(59)
            ->second(59);
			
		$arrayResult = $diarypatients->find('diary', ['conditions' => 
			[['Diarypatients.activity_date <=' => $currentDate],
            ['Diarypatients.id >' => 1],
            ['OR' => ['Diarypatients.status IS NULL', 'Diarypatients.status' => false]],
            ['OR' => ['Diarypatients.deleted_record IS NULL', 'Diarypatients.deleted_record' => false]]]]);			
			
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
        }
			
			
			


		       
        $this->set(compact('diary', 'currentDate', 'promoter'));
        $this->set('_serialize', ['diary', 'currentDate', 'promoter']);
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
            ['OR' => ['Diarypatients.deleted_record IS NULL', 'Diarypatients.deleted_record' => false]]])
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
        
        $diarypatient->short_description_activity = "Confirmar presupuesto";
        
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
            $diarypatient = $this->Diarypatients->newEntity();
            
            $diarypatient->budget_id = $idBudget;
            
            $todayDate = $currentDate;
            
            $todayDate->modify('+1 days');
    
            $diarypatient->activity_date = $todayDate;
            
            $diarypatient->short_description_activity = "Completar datos del paciente";
            
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
        
        $diarypatient->short_description_activity = "Confirmar presupuesto";
        
        $diarypatient->detailed_activity_description = "Sin detalles";
        
        $diarypatient->activity_comments = "";
        
        $diarypatient->activity_date_next = $currentDateProx;  
        
        $diarypatient->activity_next = "";
        
        $diarypatient->detailed_next_activity = "";        
        
        $diarypatient->responsible_user = 'clnacional2017';

        if ($this->Diarypatients->save($diarypatient)) 
        {
            $diarypatient = $this->Diarypatients->newEntity();
            
            $diarypatient->budget_id = $idBudget;
            
            $todayDate = $currentDate;
            
            $todayDate->modify('+1 days');
    
            $diarypatient->activity_date = $todayDate;
            
            $diarypatient->short_description_activity = "Completar datos del paciente";
            
            $diarypatient->detailed_activity_description = "Sin detalles";
            
            $diarypatient->activity_comments = "";

            $diarypatient->activity_date_next = $currentDateProx;  
            
            $diarypatient->activity_next = "";
            
            $diarypatient->detailed_next_activity = ""; 
            
            $diarypatient->responsible_user = 'clnacional2017';

            if ($this->Diarypatients->save($diarypatient)) 
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
        
        $diarypatient->activity_next = "Confirmar presupuesto con el paciente";
        
        $diarypatient->detailed_next_activity = "";        
        
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
        $diarypatient = $this->Diarypatients->get($id, [
            'contain' => ['Budgets' => ['Patients' => ['Users']]]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $diarypatient = $this->Diarypatients->patchEntity($diarypatient, $this->request->data);
            
            $diarypatient->status = true;
            
            if ($this->Diarypatients->save($diarypatient)) 
            {
                $diarypatientProx = $this->Diarypatients->newEntity();
                
                $diarypatientProx->budget_id = $diarypatient->budget_id; 

                $diarypatientProx->activity_date = $diarypatient->activity_date_next;
                
                $diarypatientProx->short_description_activity = $diarypatient->activity_next;
                
                $diarypatientProx->detailed_activity_description = $diarypatient->detail_next_activity;
                
                $diarypatientProx->activity_comments = "";
                
                setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
                date_default_timezone_set('America/Caracas');
        
                $currentDate = Time::now();
                
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
}

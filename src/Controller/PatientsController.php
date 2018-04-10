<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\BudgetsController;

use App\Controller\BinnaclesController;

use Cake\ORM\TableRegistry;

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
        $this->Auth->allow(['addWebPatient', 'restore']);
    }

    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Administrador(a) de la clínica')
            {
                if(in_array($this->request->action, ['index', 'edit', 'delete', 'previousPatient', 'restore', 'reportPatients', 'markColumns', 'arrayErrors']))
                {
                    return true;
                }
            }
			elseif ($user['role'] === 'Coordinador(a)')
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
		
		$addressTrim = trim($_POST['address']);
            
        $address = strtoupper($addressTrim);
		
		$professionTrim = trim($_POST['profession']);
            
        $profession = strtoupper($professionTrim);
        
        $patient->user_id = $idUser;
        
        $dateBirthDate = $_POST['birthdate']['year'] . '-' .  $_POST['birthdate']['month'] . '-' . $_POST['birthdate']['day'];
        
        $dateBirthDateConverted = new Time($dateBirthDate);
            
        $patient->birthdate = $dateBirthDateConverted;
        
        $patient->country = $_POST['country'];
        $patient->address = $address;
        $patient->profession = $profession;
        $patient->sponsor_type = $_POST['sponsor_type'];
        $patient->first_name_emergency = '';            
        $patient->surname_emergency = '';            
        $patient->address_emergency = '';
        $patient->landline_emergency = ''; 
        $patient->cell_phone_emergency = '';

		if ($this->Auth->user('username'))
		{
			$responsibleUser = $this->Auth->user('username');
		}
		else
		{
			$responsibleUser = 'clnacional';
		}
			
		$patient->responsible_user = $responsibleUser;

        if ($this->Patients->save($patient)) 
        {
            $lastRecord = $this->Patients->find('all', ['conditions' => [['Patients.user_id' => $idUser], ['Patients.responsible_user' => $responsibleUser]], 
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
    public function edit($id = null, $controller = null, $action = null, $idUser = null, $idPromoter = null, $promoter = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => ['Budgets']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) 
            {
                $this->Flash->success(__('Los datos se actualizaron correctamente'));
				if (isset($action))
				{
					if ($action == 'indexPatientUser')
					{
						return $this->redirect(['controller' => $controller, 'action' => $action, $idPromoter, 'Users', 'wait', $promoter]);
					}
					elseif ($action == 'viewGlobal')
					{
						return $this->redirect(['controller' => $controller, 'action' => $action, $idUser, 'Users', 'indexPatientUser', $idPromoter]);
					}
				}
            }
			else
			{
				$this->Flash->error(__('No pudieron ser actualizados los datos del paciente'));
			}
        }

        $this->set(compact('patient', 'controller', 'action', 'idUser', 'idPromoter', 'promoter'));
        $this->set('_serialize', ['patient', 'controller', 'action', 'idUser', 'idPromoter', 'promoter']);
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
	public function reportPatients()
	{	
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');
		
        $currentDate = Time::now();
		
		$binnacles = new BinnaclesController;
		
		$role = $this->Auth->user('role');

	    if ($this->request->is('post')) 
        {					
			if (isset($_POST['columnsReport']))
			{
				$columnsReport = $_POST['columnsReport'];
			}
			else
			{
				$columnsReport = [];
			}
			
			$arrayMark = $this->markColumns($columnsReport);
						
			$patients = TableRegistry::get('Patients');

			$arrayResult = $patients->find('patients');
			
			if ($arrayResult['indicator'] == 1)
			{
				$this->Flash->error(___('No se encontraron pacientes'));
				
				$binnacles->add('controller', 'Patients', 'reportPatients', 'No se encontraron pacientes');
				
				return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
			}
			else
			{
				$patientsUsers = $arrayResult['searchRequired'];
			}
	
			$swImpresion = 1;
						
			$this->set(compact('swImpresion', 'patientsUsers', 'arrayMark', 'currentDate', 'role'));
			$this->set('_serialize', ['swImpresion', 'patientsUsers', 'arrayMark', 'currenDate', 'role']); 
		
		}
		else
		{
			$swImpresion = 0;
			$this->set(compact('swImpresion'));
			$this->set('_serialize', ['swImpresion']);
		}
	}
	public function markColumns($columnsReport = null)
	{
		$arrayMark = [];
		
		isset($columnsReport['Users.sex']) ? $arrayMark['Users.sex'] = 'siExl' : $arrayMark['Users.sex'] = 'noExl';
		isset($columnsReport['Users.identidy_card']) ? $arrayMark['Users.identidy_card'] = 'siExl' : $arrayMark['Users.identidy_card'] = 'noExl';
		isset($columnsReport['Users.email']) ? $arrayMark['Users.email'] = 'siExl' : $arrayMark['Users.email'] = 'noExl';
		isset($columnsReport['Users.cell_phone']) ? $arrayMark['Users.cell_phone'] = 'siExl' : $arrayMark['Users.cell_phone'] = 'noExl';
			
		isset($columnsReport['Patients.birthdate']) ? $arrayMark['Patients.birthdate'] = 'siExl' : $arrayMark['Patients.birthdate'] = 'noExl';
		isset($columnsReport['Patients.landline']) ? $arrayMark['Patients.landline'] = 'siExl' : $arrayMark['Patients.landline'] = 'noExl';
		isset($columnsReport['Patients.country']) ? $arrayMark['Patients.country'] = 'siExl' : $arrayMark['Patients.country'] = 'noExl';
		isset($columnsReport['Patients.province_state']) ? $arrayMark['Patients.province_state'] = 'siExl' : $arrayMark['Patients.province_state'] = 'noExl';
		isset($columnsReport['Patients.city']) ? $arrayMark['Patients.city'] = 'siExl' : $arrayMark['Patients.city'] = 'noExl';
		isset($columnsReport['Patients.address']) ? $arrayMark['Patients.address'] = 'siExl' : $arrayMark['Patients.address'] = 'noExl';
		
		isset($columnsReport['Patients.profession']) ? $arrayMark['Patients.profession'] = 'siExl' : $arrayMark['Patients.profession'] = 'noExl';
		isset($columnsReport['Patients.work_phone']) ? $arrayMark['Patients.work_phone'] = 'siExl' : $arrayMark['Patients.work_phone'] = 'noExl';
		isset($columnsReport['Patients.workplace']) ? $arrayMark['Patients.workplace'] = 'siExl' : $arrayMark['Patients.workplace'] = 'noExl';
		isset($columnsReport['Patients.work_address']) ? $arrayMark['Patients.work_address'] = 'siExl' : $arrayMark['Patients.work_address'] = 'noExl';
		
		isset($columnsReport['Patients.full_name_emergency']) ? $arrayMark['Patients.full_name_emergency'] = 'siExl' : $arrayMark['Patients.full_name_emergency'] = 'noExl';		
		isset($columnsReport['Patients.cell_phone_emergency']) ? $arrayMark['Patients.cell_phone_emergency'] = 'siExl' : $arrayMark['Patients.cell_phone_emergency'] = 'noExl';
		isset($columnsReport['Patients.landline_emergency']) ? $arrayMark['Patients.landline_emergency'] = 'siExl' : $arrayMark['Patients.landline_emergency'] = 'noExl';
		isset($columnsReport['Patients.email_emergency']) ? $arrayMark['Patients.email_emergency'] = 'siExl' : $arrayMark['Patients.email_emergency'] = 'noExl';		
		isset($columnsReport['Patients.full_name_companion']) ? $arrayMark['Patients.full_name_companion'] = 'siExl' : $arrayMark['Patients.full_name_companion'] = 'noExl';
		isset($columnsReport['Patients.cell_phone_companion']) ? $arrayMark['Patients.cell_phone_companion'] = 'siExl' : $arrayMark['Patients.cell_phone_companion'] = 'noExl';
		
		isset($columnsReport['Patients.sponsor_type']) ? $arrayMark['Patients.sponsor_type'] = 'siExl' : $arrayMark['Patients.sponsor_type'] = 'noExl';
		isset($columnsReport['Patients.sponsor']) ? $arrayMark['Patients.sponsor'] = 'siExl' : $arrayMark['Patients.sponsor'] = 'noExl';
		isset($columnsReport['Patients.sponsor_identification']) ? $arrayMark['Patients.sponsor_identification'] = 'siExl' : $arrayMark['Patients.sponsor_identification'] = 'noExl';
		isset($columnsReport['Patients.cell_phone_sponsor']) ? $arrayMark['Patients.cell_phone_sponsor'] = 'siExl' : $arrayMark['Patients.cell_phone_sponsor'] = 'noExl';		
		isset($columnsReport['Patients.landline_sponsor']) ? $arrayMark['Patients.landline_sponsor'] = 'siExl' : $arrayMark['Patients.landline_sponsor'] = 'noExl';
		isset($columnsReport['Patients.email_sponsor']) ? $arrayMark['Patients.email_sponsor'] = 'siExl' : $arrayMark['Patients.email_sponsor'] = 'noExl';
		isset($columnsReport['Patients.address_sponsor']) ? $arrayMark['Patients.address_sponsor'] = 'siExl' : $arrayMark['Patients.address_sponsor'] = 'noExl';
		
		return $arrayMark;
	}
	public function modifyData()
	{
		$binnacles = new BinnaclesController;
		
		$arrayRecords = [873, 414, 247, 210, 431, 585, 697, 949, 666, 871, 1011, 
			1043, 230, 214, 618, 1020, 566, 825, 826, 718, 719, 
			179, 200, 201, 204, 213, 215, 237, 253, 258];
			
		$accountUpdate = 0;
		
		foreach ($arrayRecords as $arrayRecord)
		{
			$patient = $this->Patients->get($arrayRecord);
			
			$patient->country = 'VENEZUELA';
			
			if (!($this->Patients->save($patient))) 
			{
				if($patient->errors())
				{
					$error_msg = $this->arrayErrors($patient->errors());
					
					$this->Flash->error(__('El registro: ' . $arrayRecord . ' no pudo ser actualizado debido a: ' . implode(' - ', $error_msg)));
				}
				else
				{
					$this->Flash->error(__('No se pudo actualizar el registro ' . $arrayRecord . ' por error desconocido'));
					
					$error_msg = ['No se pudo actualizar el registro: error desconocido'];
				}
				foreach($error_msg as $noveltys)
				{
					$binnacles->add('controller', 'Patients', 'modifyData', $noveltys . 'Registro ' . $arrayRecord);
				}
			}	
			else
			{
				$accountUpdate++;
			}
		}
		$this->Flash->success(__('Total pacientes actualizados: ' . $accountUpdate));
	}
	public function arrayErrors($arrayCake = null)
	{
		$error_msg = [];
		
		foreach($arrayCake as $errors)
		{
			if(is_array($errors))
			{
				foreach($errors as $error)
				{
					
					$error_msg[] = $error;
				}
			}
			else
			{
				$error_msg[] = $errors;
			}
		}
		
		return $error_msg;
	}
}
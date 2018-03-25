<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

use Cake\I18n\Time;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['addWebEmployee', 'verifyEmployee', 'restore']);
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
                if(in_array($this->request->action, ['addAutomatic', 'edit', 'restore']))
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
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
        $this->set('_serialize', ['employees']);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);

        $this->set('employee', $employee);
        $this->set('_serialize', ['employee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
        $this->set('_serialize', ['employee']);
    }
    public function addAutomatic($idUser = null)
    {
        $this->autoRender = false;
        
        $employee = $this->Employees->newEntity();
        
        $employee->user_id = $idUser;

        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $employee->birthdate = Time::now();

        $employee->position_id = 1;

        if ($this->Auth->user('username'))
        {
            $employee->responsible_user = $this->Auth->user('username');
        }
        if ($this->Employees->save($employee)) 
        {
            $result = 0;
        }
        else
        {
            $result = 1;
        }
        return $result;
    }

    public function addWebEmployee($idUser = null)
    {
        $this->autoRender = false;
       
        $lastRecord = $this->Employees->find('all', ['conditions' => ['Employees.user_id' => $idUser], 
            'order' => ['Employees.created' => 'DESC'] ]);

        $row = $lastRecord->first();
        
        if ($row)
        {
            $result = 2;
        }
        else
		{    
			$employee = $this->Employees->newEntity();
			
			$employee->user_id = $idUser;

			setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
			date_default_timezone_set('America/Caracas');

			$employee->birthdate = Time::now();

			$employee->position_id = 1;

			if ($this->Auth->user('username'))
			{
				$employee->responsible_user = $this->Auth->user('username');
			}
			if ($this->Employees->save($employee)) 
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
	
    public function edit($id = null, $controller = null, $action = null)
    {
        $employee = $this->Employees->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if ($this->Employees->save($employee)) 
            {
                $this->Flash->success(__('Los datos se completaron correctamente'));

				if ($this->Auth->user('id') == $employee->user_id)
				{
					return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
				}
				else
				{
					return $this->redirect(['controller' => 'users', 'action' => 'index']);
				}
            }
            $this->Flash->error(__('Los datos del usuario no se pudieron completar'));
        }

        $this->set(compact('employee', 'controller', 'action'));
        $this->set('_serialize', ['employee', 'controller', 'action']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        $employee->record_deleted = true;
        if ($this->Employees->save($employee)) 
        {
            $result = 0; 
        } else {
            $result = 1;
        }

        return $result;
    }
    public function restore($id = null)
    {
        $employee = $this->Employees->get($id);
        $employee->record_deleted = null;
        if ($this->Employees->save($employee)) 
        {
            $result = 0; 
        } else {
            $result = 1;
        }

        return $result;
    }
    public function verifyEmployee($idUser = null)
    {
        $employees = TableRegistry::get('Employees');
        
        $arrayResult = $employees->find('only', ['user_id' => $idUser]);
        
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
	public function reportEmployees()
	{	
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');
		
        $currentDate = Time::now();
		
		$binnacles = new BinnaclesController;

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
						
			$employees = TableRegistry::get('Employees');

			$arrayResult = $employees->find('employees');
			
			if ($arrayResult['indicator'] == 1)
			{
				$this->Flash->error(___('No se encontraron usuarios'));
				
				$binnacles->add('controller', 'Employees', 'reportEmployees', 'No se encontraron usuarios');
				
				return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
			}
			else
			{
				$employeesUsers = $arrayResult['searchRequired'];
			}
	
			$swImpresion = 1;
						
			$this->set(compact('swImpresion', 'employeesUsers', 'arrayMark', 'currentDate'));
			$this->set('_serialize', ['swImpresion', 'employeesUsers', 'arrayMark', 'currenDate']); 
		
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
			
		isset($columnsReport['Employees.rif']) ? $arrayMark['Employees.rif'] = 'siExl' : $arrayMark['Employees.rif'] = 'noExl';
		isset($columnsReport['Employees.landline']) ? $arrayMark['Employees.landline'] = 'siExl' : $arrayMark['Employees.landline'] = 'noExl';
		isset($columnsReport['Employees.address']) ? $arrayMark['Employees.address'] = 'siExl' : $arrayMark['Employees.address'] = 'noExl';
		isset($columnsReport['Employees.birthdate']) ? $arrayMark['Employees.birthdate'] = 'siExl' : $arrayMark['Employees.birthdate'] = 'noExl';
		isset($columnsReport['Employees.place_of_birth']) ? $arrayMark['Employees.place_of_birth'] = 'siExl' : $arrayMark['Employees.place_of_birth'] = 'noExl';
		isset($columnsReport['Employees.country_of_birth']) ? $arrayMark['Employees.country_of_birth'] = 'siExl' : $arrayMark['Employees.country_of_birth'] = 'noExl';
		isset($columnsReport['Employees.degree_instruction']) ? $arrayMark['Employees.degree_instruction'] = 'siExl' : $arrayMark['Employees.degree_instruction'] = 'noExl';
		isset($columnsReport['Employees.payment_method']) ? $arrayMark['Employees.payment_method'] = 'siExl' : $arrayMark['Employees.payment_method'] = 'noExl';
		isset($columnsReport['Employees.account_bank']) ? $arrayMark['Employees.account_bank'] = 'siExl' : $arrayMark['Employees.account_bank'] = 'noExl';
		isset($columnsReport['Employees.account_type']) ? $arrayMark['Employees.account_type'] = 'siExl' : $arrayMark['Employees.account_type'] = 'noExl';
		isset($columnsReport['Employees.bank']) ? $arrayMark['Employees.bank'] = 'siExl' : $arrayMark['Employees.bank'] = 'noExl';
		isset($columnsReport['Employees.bank_address']) ? $arrayMark['Employees.bank_address'] = 'siExl' : $arrayMark['Employees.bank_address'] = 'noExl';
		isset($columnsReport['Employees.swif_bank']) ? $arrayMark['Employees.swif_bank'] = 'siExl' : $arrayMark['Employees.swif_bank'] = 'noExl';
		isset($columnsReport['Employees.aba_bank']) ? $arrayMark['Employees.aba_bank'] = 'siExl' : $arrayMark['Employees.aba_bank'] = 'noExl';
		
		return $arrayMark;
	}
}
<?php
namespace App\Controller;

use App\Controller\AppController;

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

	public function SearchEmployee($idUser = null)
	{
		$this->autoRender = false;
	
		$arrayResult = [];
			
		$lastRecord = $this->Employees->find('all', ['contain' => ['Users'], 'conditions' => ['user_id' => $idUser], 
				'order' => ['Employees.created' => 'DESC'] ]);

		$row = $lastRecord->first();
			
        if ($row)
        {
            $arrayResult['indicator'] = 0;
            $arrayResult['searchRequired'] = $row;
        }
        else
        {
            $arrayResult['indicator'] = 1;
        }
        return $arrayResult;
			
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
}

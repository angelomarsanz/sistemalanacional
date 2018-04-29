<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\SystemsController;

use App\Controller\BinnaclesController;

use App\Controller\EmployeesController;

use App\Controller\PatientsController;

use App\Controller\BudgetsController;

use App\Controller\ServicesController;

use App\Controller\ItemesController;

use Cake\ORM\TableRegistry;

use Cake\I18n\Time;

use Cake\Mailer\Email;

use Cake\Filesystem\File;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['testComunicationSend', 'addWeb', 'addWebF', 'checkData', 'addWebBasic', 'addWebBasicF', 'mailPromoter', 'mailBudget', 'restore', 'recoverPassword', 
			'mailRecoverPassword']);
    }

    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] == 'Auditor(a) externo' || $user['role'] == 'Auditor(a) interno' || $user['role'] == 'Administrador(a) de la clínica')
            {
                if(in_array($this->request->action, ['home', 'addBasic', 'editBasic', 'indexPatientUser', 'view', 'viewBasic', 'editBasic', 'delete', 'deleteBasic', 'logout', 'checkUser', 'viewGlobal', 'confirmPatient', 'restore', 'wait', 'findPatient', 'index', 'add', 'edit', 'confirmUser', 'restoreUser', 'previousUser', 'findUser', 'findPromoter', 'indexBasic', 'reasignUser', 'findPromoterMulti', 
                       'arrayErrors']))
                {
                    return true;
                }
            }
            elseif ($user['role'] == 'Coordinador(a)')
            {
                if(in_array($this->request->action, ['home', 'addBasic', 'editBasic', 'indexPatientUser', 'view', 'viewBasic', 'editBasic', 'delete', 'deleteBasic', 'logout', 'checkUser', 'viewGlobal', 'confirmPatient', 'restore', 'wait', 'findPatient', 'index', 'add', 'edit', 'confirmUser', 'restoreUser', 'previousUser', 'findUser', 'findPromoter', 'indexBasic', 'reasignUser', 
                       'arrayErrors']))
                {
                    return true;
                }
            }			
            elseif ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['home', 'addBasic', 'editBasic', 'indexPatientUser', 'view', 'viewBasic', 'editBasic', 'delete', 'deleteBasic', 'logout', 'checkUser', 'viewGlobal', 'confirmPatient', 'restore', 'wait', 'findPatient', 'index', 'add', 'edit', 'confirmUser', 'restoreUser', 'arrayErrors']))
                {
                    return true;
                }                
            }
            elseif ($user['role'] === 'Call center')
            {
                if(in_array($this->request->action, ['home', 'addBasic', 'editBasic', 'indexPatientUser', 'view', 'viewBasic', 'editBasic', 'delete', 'deleteBasic', 'logout', 'checkUser', 'viewGlobal', 'confirmPatient', 'restore', 'wait', 'arrayErrors']))
                {
                    return true;
                }                
            }
        }
        return parent::isAuthorized($user);
    }        

    public function testFunction()
    {
		$prueba = 'angelito';
		
		if (strtoupper($prueba) == 'ANGELITO')
		{
			$this->Flash->success(__('strtoupper($prueba) contiene ANGELITO'));
		}
		else
		{
			$this->Flash->success(__('strtoupper($prueba) no contiene ANGELITO'));	
		}	
    }

    public function testComunicationSend()
    {

    }
    
    public function serverError()
    {

    }

    public function login()
    {
        if($this->request->is('post'))
        {
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user); 
                
                $this->loadModel('Systems');

                $system = $this->Systems->get(2);

                if ($system->system_switch == true)
                {
                    return $this->redirect($this->Auth->redirectUrl());
                }
                else
                {
                    if ($this->Auth->user('username') == 'angelsanz')
                    {
                        return $this->redirect($this->Auth->redirectUrl());
                    }
                    else
                    {
                        $this->Flash->error(__('Estimado usuario, en estos momentos estamos haciendo labores de mantenimiento en el sistema, por favor intente más tarde..'));
                        
                        return $this->redirect(['controller' => 'Users', 'action' => 'logout']); 
                    }
                }
            }
            else
            {
                $this->Flash->error('Datos invalidos, por favor intente nuevamente', ['key' => 'auth']);
            }
        }
    }

    public function home()
    {
        $this->render();
        
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $query = $this->Users->find('all')->where
            ([['Users.id <>' => 1],
            ['Users.role <>' => 'Desarrollador del sistema'],
            ['Users.role <>' => 'Administrador(a) del sistema'],
            ['Users.role <>' => 'Titular del sistema'],
            ['Users.role <>' => 'Auditor(a) externo'],
            ['Users.role <>' => 'Auditor(a) interno'],
            ['Users.role <>' => 'Paciente'],
            [['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]]])
            ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC']);

        $this->set('users', $this->paginate($query));
        
        $currentView = 'usersIndex';
        
        $this->set(compact('users', 'currentView'));
        $this->set('_serialize', ['users', 'currentView']);
    }

    public function indexPatientUser($idPromoter = null, $controller = null, $action = null, $promoter = null)
    {
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
				
        if ($this->request->is('post')) 
        {
            $users = $this->Users->find('all')->where
                ([['Users.parent_user' => $_POST['id']],
                ['Users.role' => 'Paciente'],
                [['OR' => [['Users.deleted_record IS NULL'], ['Users.deleted_record' => 0]]]]])
                ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC']);

            $promoter = $_POST['name'];
			$idPromoter = $_POST['id'];
        }
        else
        {
			if (!(isset($idPromoter)))
			{
				$idPromoter = $this->Auth->user('id');
				$promoter = $this->Auth->user('surname') . ' ' . $this->Auth->user('first_name'); 
			}
            $users = $this->Users->find('all')->where
                ([['Users.parent_user' => $idPromoter],
                ['Users.role' => 'Paciente'],
                [['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]]])
                ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC']);
        }

		$count = $users->count();
		
		if ($count == 0)
		{
			$users = null;
		}
		
        $currentView = 'indexPatientUser';
        
        $this->set(compact('system', 'users', 'promoter', 'currentView', 'idPromoter'));
        $this->set('_serialize', ['system', 'users', 'promoter', 'currentView', 'idPromoter']);
    }

    public function indexBasic()
    {
        $query = $this->Users->find('all')->where
            ([['Users.role' => 'Paciente'],
            [['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]]]);

        $this->set('users', $this->paginate($query));
        
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
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
            if (isset($_POST['status']))
            {
                $this->Flash->error(__('Este usuario ya está registrado en la Base de Datos. Por favor verifique...'));    
            }
        }
        $user = $this->Users->get($id, [
            'contain' => ['Employees', 'Patients']]);
            
        $query = $this->Users->find('all')->where([['Users.parent_user' => $id], 
                    ['Users.role' => 'Paciente'],
                    ['OR' => [['Users.deleted_record IS NULL'], ['Users.deleted_record' => 0]]]      ]);
        
        $currentView = 'usersView';
        
        $this->set('user', $user);
        $this->set('_serialize', ['user', 'controller', 'action', 'currentView']);
        $this->set(compact('controller', 'action', 'query', 'currentView'));
    }
    
    public function viewBasic($id = null, $controller = null, $action = null, $idUser = null)
    {
        if ($this->request->is('post')) 
        {
            $id = $_POST['idUser'];
            $controller = $_POST['controller'];
            $action = $_POST['action'];
        }
        
        $user = $this->Users->get($id, [
            'contain' => ['Patients']]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $this->set(compact('controller', 'action', 'idUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($controller = null, $action = null)
    {
        $employee = new EmployeesController;
        	
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
		date_default_timezone_set('America/Caracas');

		$currentDate = time::now();
	
        $user = $this->Users->newEntity();
		
        if ($this->request->is('post')) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
			
			$firstNameTrim = trim($user->first_name);
			
			$firstName = strtoupper($firstNameTrim);
			
			$surnameTrim = trim($user->surname);
			
			$surname = strtoupper($surnameTrim);

			$emailTrim = trim($user->email);
	
			$email = strtolower($emailTrim);	

			$firstNameSurname = strtolower($firstNameTrim) . strtolower($surnameTrim);

			$users = TableRegistry::get('Users');
			
			$arrayResult = $users->find('username', ['firstname_surname' => $firstNameSurname]);
			
			if ($arrayResult['indicator'] == 0)
			{
				$consecutive = $arrayResult['searchRequired'] + 1;  
				
				$username = $firstNameSurname . $consecutive;
				
				$user->username = $username;
			}
			else 
			{
				$username = $firstNameSurname . '1';
				
				$user->username = $username;
			}

			$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';

			$user->password = $password;
			
            if ($this->Auth->user('id'))
            {
                $user->parent_user = $this->Auth->user('id');
            }
            else
            {
                $user->parent_user = 1;
            }

            if ($this->Auth->user('username'))
            {
                $user->responsible_user = $this->Auth->user('username');
				$responsibleUser = $this->Auth->user('username');
            }
			else
			{
				$user->responsible_user = 'clnacional2017';	
				$responsibleUser = 'clnacional2017';				
			}			
			
			$user->first_name = $firstName;
			$user->second_name = '';
			$user->surname = $surname;
			$user->second_surname = '';
			$user->email = $email;
			$user->user_status = 'ACTIVO';
			$user->reason_status = 'PROMOTOR NUEVO';
			$user->date_status = $currentDate;
            
            if ($this->Users->save($user)) 
            {
                $query = $this->Users->find('all')->where([['Users.username' => $username], 
                    ['Users.responsible_user' => $responsibleUser]]);
                    
                $arrayUser = $query->toArray();
                               
                $result = $employee->addAutomatic($arrayUser[0]['id']);

				if ($result == 0)
                {
                    if ($this->Auth->user('username'))
                    {
						$resultPromoter = 0;
						$result = $this->mailPromoter($email, $firstName, $username, $password, $resultPromoter);
                        $this->Flash->success(__('El usuario se creo exitosamente'));
                        return $this->redirect(['controller' => $controller, 'action' => $action]); 
                    }
                    else
                    {
                        $this->Flash->success(__('Los datos se guardaron correctamente, por favor escriba su usuario, la contraseña y pulsa el botón ACCEDER'));
                        return $this->redirect(['action' => 'login']);                      
                    }
                }
                else
                {
                    $this->Flash->error(__('Los datos de usuario no se guardaron correctamente, por favor intente nuevamente'));
                }
            }
            else
            {
                $this->Flash->error(__('Los datos de usuario no se guardaron en la tabla user, por favor intente nuevamente'));    
            }
        }
        
        $this->set(compact('user', 'controller', 'action'));
        $this->set('_serialize', ['user', 'controller', 'action']);
    }

    public function addWeb()
    {
        $this->autoRender = false;

        $jsondata = [];
		
        $employee = new EmployeesController;

        if ($this->request->is('post')) 
        {			
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();

			$swPost = $this->checkData();
			
			if ($swPost == 0)
			{
				$firstNameTrim = trim($_POST['firstName']);
				
				$firstName = strtoupper($firstNameTrim);
				
				$surnameTrim = trim($_POST['surname']);
				
				$surname = strtoupper($surnameTrim);

				$emailTrim = trim($_POST['email']);
		
				$email = strtolower($emailTrim);				
				
				$lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => 'Promotor(a) independiente'], ['Users.email' => $email]], 
					'order' => ['Users.created' => 'DESC']]);
				
				$row = $lastRecord->first();

				if ($row)
				{
					$user = $this->Users->get($row->id);

					if ($user->user_status != 'ACTIVO')
					{
						$user->user_status = 'ACTIVO';

						$user->reason_status = 'REINCORPORACIÓN AUTOMÁTICA';

						$user->date_status = $currentDate;
						
						$user->deleted_record = null;
						
						$result = $employee->verifyEmployee($user->id);
					}
		
					$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
					
					$user->password = $password;  
					
					if ($this->Users->save($user))
					{
						$resultPromoter = 2;
						
						$result = $this->mailPromoter($email, $firstName, $row->username, $password, $resultPromoter);
						
						if ($result == 0)
						{
							$jsondata['success'] = false;
							$jsondata['data'] = 'Usuario ya registrado';
						}
						else
						{
							$jsondata['success'] = false;
							$jsondata['data'] = 'No se pudo enviar el correo';
						}
					}
				}
				else
				{
					$user = $this->Users->newEntity();
				
					$user->parent_user = 1;
				
					$firstNameSurname = strtolower($firstNameTrim) . strtolower($surnameTrim);

					$users = TableRegistry::get('Users');
					
					$arrayResult = $users->find('username', ['firstname_surname' => $firstNameSurname]);
					
					if ($arrayResult['indicator'] == 0)
					{
						$consecutive = $arrayResult['searchRequired'] + 1;  
						
						$username = $firstNameSurname . $consecutive;
						
						$user->username = $username;
					}
					else 
					{
						$username = $firstNameSurname . '1';
						
						$user->username = $username;
					}

					$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
					
					$user->password = $password;
					$user->type_of_identification = $_POST['typeOfIdentification'];
					$user->identidy_card = $_POST['identidyCard'];
					$user->role = 'Promotor(a) independiente';
					$user->first_name = $firstName;
					$user->second_name = '';
					$user->surname = $surname;
					$user->second_surname = '';
					$user->sex = $_POST['sex'];
					$user->email = $email;
					$user->cell_phone = $_POST['cellPhone'];
					$user->user_status = 'ACTIVO';
					$user->reason_status = 'PROMOTOR NUEVO';
					$user->date_status = $currentDate;
					$user->responsible_user = 'clnacional2017';
					
					if ($this->Users->save($user)) 
					{
						$lastRecord = $this->Users->find('all', ['conditions' => ['Users.username' => $username], 
							'order' => ['Users.created' => 'DESC']]);
				
						$row = $lastRecord->first();
					
						if ($row)
						{
							$idUser = $row->id;

							$result = $employee->addWebEmployee($idUser);
			
							if ($result == 0)
							{
								$jsondata['success'] = true;
								$jsondata['data'] = 'El usuario y el promotor se registraron exitosamente ';
								
							}
							elseif ($result == 1)
							{
								$jsondata['success'] = false;
								$jsondata['data'] = 'Se creó el usuario, pero el promotor no';
							}
							else
							{
								$jsondata['success'] = false;
								$jsondata['data'] = 'Se creó el usuario, pero el promotor ya estaba registrado';
							}
							$resultPromoter = 0;
						}
					}
					else
					{
						$jsondata['success'] = false;
						$jsondata['data'] = 'No se pudo crear el usuario';
						$resultPromoter = 1;
					}

					$result = $this->mailPromoter($email, $firstName, $user->username, $password, $resultPromoter);
					if ($result == 0)
					{
						$jsondata['success'] = true;
						$jsondata['data'] = 'El email fue enviado';
					}
					else
					{
						$jsondata['success'] = false;
						$jsondata['data'] = 'El email no pudo ser enviado';						
					}
				}
			}
			else
			{
				$jsondata['success'] = false;
				$jsondata['data'] = 'Datos recibidos con valores inválidos';
			}
            exit(json_encode($jsondata, JSON_FORCE_OBJECT));
        }
    }
	
    public function mailPromoter($email = null, $firstName = null, $username = null, $password = null, $resultPromoter = null)
    {
		if ($resultPromoter == 0 || $resultPromoter == 2)
		{
			$subject = 'Registro de promotor satisfactorio';
		}
		else
		{
			$subject = 'Registro de promotor';
		}
        $correo = new Email(); 
        $correo
          ->transport('donWeb')
          ->template('email_promoter') 
          ->emailFormat('html') 
          ->to($email) 
          ->from(['noresponder@cirugiaslanacional.com' => 'Cirugías La Nacional']) 
          ->subject($subject) 
          ->viewVars([ 
            'varResultPromoter' => $resultPromoter,
            'varPromoter' => $firstName,
            'varUsername' => $username,
            'varPassword' => $password,
          ]);

		$file1 = new file( WWW_ROOT.'files/annexes/instructivosln.pdf');
		
		$file2 = new file( WWW_ROOT.'files/annexes/manualdenegocios.pdf');
		
		if ($resultPromoter == 0 || $resultPromoter == 2)
		{
			$correo->attachments([
				$file1->name => [
					'file' => $file1->path],
				$file2->name => [
					'file' => $file2->path],
				]);
		}
		
        $correo->SMTPAuth = true;
        $correo->CharSet = "utf-8";     

        if($correo->send())
        {
            $result = 0;
        }
        else
        {
            $result = 1;
        }
        
        return $result;
    }
	
	public function checkData()
	{			
		$swPost = 0;

		if (!(isset($_POST['typeOfIdentification']))):
			$swPost = 1;
		elseif ($_POST['typeOfIdentification'] == ''):
			$swPost = 1;
		endif;

		if (!(isset($_POST['identidyCard']))):
			$swPost = 1;
		elseif ($_POST['identidyCard'] == ''):
			$swPost = 1;
		elseif ($_POST['identidyCard'] == 0):
			$swPost = 1;		
		endif;

		if (!(isset($_POST['firstName']))):
			$swPost = 1;
		elseif ($_POST['firstName'] == ''):
			$swPost = 1;
		endif;
		
		if (!(isset($_POST['surname']))):
			$swPost = 1;
		elseif ($_POST['surname'] == ''):
			$swPost = 1;
		endif;
		
		if (!(isset($_POST['sex']))):
			$swPost = 1;
		elseif ($_POST['sex'] == ''):
			$swPost = 1;		
		endif;
		
		if (!(isset($_POST['cellPhone']))):
			$swPost = 1;
		elseif ($_POST['cellPhone'] == ''):
			$swPost = 1;		
		endif;
		
		if (!(isset($_POST['email']))):
			$swPost = 1;
		elseif ($_POST['email'] == ''):
			$swPost = 1;
		endif;
		
		return $swPost;
	}

// Función creada solo para pruebas de comunicación 

    public function addWebF()
    {
        $jsondata = [];
		
        $employee = new EmployeesController;

        if ($this->request->is('post')) 
        {			
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();

			$swPost = $this->checkData();
			
			if ($swPost == 0)
			{
				$firstNameTrim = trim($_POST['firstName']);
				
				$firstName = strtoupper($firstNameTrim);
				
				$surnameTrim = trim($_POST['surname']);
				
				$surname = strtoupper($surnameTrim);

				$emailTrim = trim($_POST['email']);
		
				$email = strtolower($emailTrim);				
				
				$lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => 'Promotor(a) independiente'], ['Users.email' => $email]], 
					'order' => ['Users.created' => 'DESC']]);
				
				$row = $lastRecord->first();

				if ($row)
				{
					$user = $this->Users->get($row->id);

					if ($user->user_status != 'ACTIVO')
					{
						$user->user_status = 'ACTIVO';

						$user->reason_status = 'REINCORPORACIÓN AUTOMÁTICA';

						$user->date_status = $currentDate;
						
						$user->deleted_record = null;
						
						$result = $employee->verifyEmployee($user->id);
					}
		
					$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
					
					$user->password = $password;  
					
					if ($this->Users->save($user))
					{
						$resultPromoter = 2;
						
						$result = $this->mailPromoter($email, $firstName, $row->username, $password, $resultPromoter);
						
						if ($result == 0)
						{
							$jsondata['success'] = false;
							$jsondata['data'] = 'Usuario ya registrado';
						}
						else
						{
							$jsondata['success'] = false;
							$jsondata['data'] = 'No se pudo enviar el correo';
						}
					}
				}
				else
				{
					$user = $this->Users->newEntity();
				
					$user->parent_user = 1;
				
					$firstNameSurname = strtolower($firstNameTrim) . strtolower($surnameTrim);

					$users = TableRegistry::get('Users');
					
					$arrayResult = $users->find('username', ['firstname_surname' => $firstNameSurname]);
					
					if ($arrayResult['indicator'] == 0)
					{
						$consecutive = $arrayResult['searchRequired'] + 1;  
						
						$username = $firstNameSurname . $consecutive;
						
						$user->username = $username;
					}
					else 
					{
						$username = $firstNameSurname . '1';
						
						$user->username = $username;
					}

					$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
					
					$user->password = $password;
					$user->type_of_identification = $_POST['typeOfIdentification'];
					$user->identidy_card = $_POST['identidyCard'];
					$user->role = 'Promotor(a) independiente';
					$user->first_name = $firstName;
					$user->second_name = '';
					$user->surname = $surname;
					$user->second_surname = '';
					$user->sex = $_POST['sex'];
					$user->email = $email;
					$user->cell_phone = $_POST['cellPhone'];
					$user->user_status = 'ACTIVO';
					$user->reason_status = 'PROMOTOR NUEVO';
					$user->date_status = $currentDate;
					$user->responsible_user = 'clnacional2017';
					
					if ($this->Users->save($user)) 
					{
						$lastRecord = $this->Users->find('all', ['conditions' => ['Users.username' => $username], 
							'order' => ['Users.created' => 'DESC']]);
				
						$row = $lastRecord->first();
					
						if ($row)
						{
							$idUser = $row->id;

							$result = $employee->addWebEmployee($idUser);
			
							if ($result == 0)
							{
								$jsondata['success'] = true;
								$jsondata['data'] = 'El usuario y el promotor se registraron exitosamente ';
								
							}
							elseif ($result == 1)
							{
								$jsondata['success'] = false;
								$jsondata['data'] = 'Se creó el usuario, pero el promotor no';
							}
							else
							{
								$jsondata['success'] = false;
								$jsondata['data'] = 'Se creó el usuario, pero el promotor ya estaba registrado';
							}
							$resultPromoter = 0;
						}
					}
					else
					{
						$jsondata['success'] = false;
						$jsondata['data'] = 'No se pudo crear el usuario';
						$resultPromoter = 1;
					}

					$result = $this->mailPromoter($email, $firstName, $user->username, $password, $resultPromoter);
					if ($result == 0)
					{
						$jsondata['success'] = true;
						$jsondata['data'] = 'El email fue enviado';
					}
					else
					{
						$jsondata['success'] = false;
						$jsondata['data'] = 'El email no pudo ser enviado';						
					}
				}
			}
			else
			{
				$jsondata['success'] = false;
				$jsondata['data'] = 'Datos recibidos con valores inválidos';
			}
            exit(json_encode($jsondata, JSON_FORCE_OBJECT));
        }
    }	
	
    public function addBasic($controller = null, $action = null)
    {
        $patient = new PatientsController;
        
        $budget = new BudgetsController;
		
        $service = new ServicesController;
		
        $iteme = new ItemesController;
        
        $diarypatient = new DiarypatientsController;
        
        if ($this->request->is('post')) 
        {		
            $user = $this->Users->newEntity();
			
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();
          
            $firstNameTrim = trim($_POST['first_name']);
            
            $firstName = strtoupper($firstNameTrim);

            $surnameTrim = trim($_POST['surname']);
            
            $surname = strtoupper($surnameTrim);
			
            $emailTrim = trim($_POST['email']);
            
            $email = strtolower($emailTrim);
			
            $addressTrim = trim($_POST['address']);
            
            $address = strtoupper($addressTrim);
            
            $firstNameSurname = strtolower($firstName) . strtolower($surname);
            
            $users = TableRegistry::get('Users');
            
            $arrayResult = $users->find('username', ['firstname_surname' => $firstNameSurname]);
            
            if ($arrayResult['indicator'] == 0)
            {
                $consecutive = $arrayResult['searchRequired'] + 1;  
                
                $username = $firstNameSurname . $consecutive;
            }
            else 
            {
                $username = $firstNameSurname . '1';
            }
            
            $password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
			
			$user->username = $username;
			$user->password = $password;
			$user->type_of_identification = $_POST['type_of_identification'];
			$user->identidy_card = $_POST['identidy_card'];
			$user->role = $_POST['role'];
			$user->first_name = $firstName;
			$user->surname = $surname;
			$user->sex = $_POST['sex'];
			$user->email = $email;
			$user->cell_phone = $_POST['cell_phone'];
                
			if ($this->Auth->user('id'))
			{
				$user->parent_user = $this->Auth->user('id');
			}
			else
			{
				$user->parent_user = 1;
			}
                
			if ($this->Auth->user('username'))
			{
				$responsibleUser = $this->Auth->user('username');
			}
			else
			{
				$responsibleUser = 'clnacional';
			}
			
			$user->user_status = 'ACTIVO';
			
			$user->reason_status = 'NUEVO PACIENTE';
			
			$user->date_status = $currentDate;
			
			$user->responsible_user = $responsibleUser;
                   
			if ($this->Users->save($user)) 
			{
				$query = $this->Users->find('all')->where([['Users.username' => $user->username], 
					['Users.responsible_user' => $responsibleUser]]);
					
				$arrayUser = $query->toArray();
				
				$idPatient = $patient->addAutomatic($arrayUser[0]['id']);

				if ($idPatient > 0)
				{				
                    $arrayMail = [];

                    $arrayResult = $service->getService($_POST['surgery']);

					$arrayMail['mail'] = $email;
					$arrayMail['surgery'] = $arrayResult['serviceDescription'];
					$arrayMail['costBolivars'] = $arrayResult['costBolivars'];
					$arrayMail['costDollars'] = $arrayResult['costDollars'];
					$arrayMail['itemes'] = nl2br(htmlentities($arrayResult['itemes']));
					$itemesBudget = $arrayResult['itemes'];
					
					if (strtoupper($_POST['country']) == 'VENEZUELA')
					{
						$arrayResult = $budget->addAutomatic($idPatient, $arrayResult['serviceDescription'], 'BOLIVAR', $arrayMail['costBolivars']);                            
					}
					else
					{
						$arrayResult = $budget->addAutomatic($idPatient, $arrayResult['serviceDescription'], 'DOLLAR', $arrayMail['costDollars']);                            
					}

					if($arrayResult['indicator'] == 0)
					{				
						$arrayMail['subject'] = 'Presupuesto ' . $arrayResult['codeBudget']; 
						$arrayMail['firstName'] = $firstName;
						$arrayMail['surname'] = $surname;
						$arrayMail['identidy'] = $_POST['type_of_identification'] . '-' . $_POST['identidy_card'];
						$arrayMail['phone'] = $_POST['cell_phone'];
						$arrayMail['address'] = $address;
						$arrayMail['country'] = $_POST['country'];
						$arrayMail['codeBudget'] = $arrayResult['codeBudget']; 
						$arrayMail['dateBudget'] = $arrayResult['dateBudget'];
						$arrayMail['expirationDate'] = $arrayResult['expirationDate'];
						$arrayMail['namePromoter'] = $this->Auth->user('first_name') . ' ' . $this->Auth->user('surname');
						$arrayMail['mailPromoter'] = $this->Auth->user('email');
						$arrayMail['phonePromoter'] = $this->Auth->user('cell_phone');
						
						$idBudget = $arrayResult['id'];
						
						$result = $iteme->add($idBudget, $itemesBudget);
						
						$result = $diarypatient->addAutomatic($idBudget);
					
						if ($result == 0)
						{
							$result = $this->mailBudget($arrayMail);
							if ($this->Auth->user('username'))
							{
								$this->Flash->success(__('El paciente se creo exitosamente'));
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
					$this->Flash->error(__('No se pudieron grabar los datos básicos del paciente'));
				}
			}
			else
			{
				$this->Flash->error(__('No se pudieron grabar los datos del usuario - paciente'));    
			}
            
			if ($controller == null)
			{
				return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
			}
			else
			{
				return $this->redirect(['controller' =>  $controller, 'action' => $action]); 
			}
        }

		$this->loadModel('Services');		
		
		$services = $this->Services->find('list', ['limit' => 200, 'conditions' => [['Services.registration_status' => 'ACTIVO'], ['OR' => [['Services.cost_bolivars >' => 0], ['Services.cost_dollars >' => 0]]]], 'order' => ['Services.service_description' => 'ASC']]);
	
        $this->set(compact('controller', 'action', 'services'));
    }

    public function addWebBasic()
    {
        $this->autoRender = false;
		
		$binnacles = new BinnaclesController;

        $patient = new PatientsController;
        
        $budget = new BudgetsController;
        
        $diarypatient = new DiarypatientsController;
        
        $service = new ServicesController;
        
        $iteme = new ItemesController;

        if ($this->request->is('post')) 
        {
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();

            $jsondata = [];
			
			$result = $this->validateFields($_POST);
			
			if ($result == 0)
            {
				$firstNameTrim = trim($_POST['firstName']);
				
				$firstName = strtoupper($firstNameTrim);

				$surnameTrim = trim($_POST['surname']);
				
				$surname = strtoupper($surnameTrim);
				
				$firstNameSurname = strtolower($firstName) . strtolower($surname);
				
				$users = TableRegistry::get('Users');
				
				$arrayResult = $users->find('username', ['firstname_surname' => $firstNameSurname]);
				
				if ($arrayResult['indicator'] == 0)
				{
					$consecutive = $arrayResult['searchRequired'] + 1;  
					
					$username = $firstNameSurname . $consecutive;
				}
				else 
				{
					$username = $firstNameSurname . '1';
				}
				
				$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
				
				$birthdate = $_POST['birthdate'];
						
				$countryTrim = trim($_POST['country']);
				
				$country = strtoupper($countryTrim);
		
				$addressTrim = trim($_POST['address']);
				
				$address = strtoupper($addressTrim);
				
				$surgeryTrim = trim($_POST['surgery']);
				
				$surgery = strtoupper($surgeryTrim);
				
				$emailTrim = trim($_POST['email']);
				
				$email = strtolower($emailTrim);
				
				$lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => 'Paciente'], ['Users.email' => $email]], 
					'order' => ['Users.created' => 'DESC']]);
				
				$row = $lastRecord->first();
					
				if ($row)
				{
					$idUser = $row->id;
					
					if ($row->user_status != 'ACTIVO' || $row->deleted_record == true)
					{
						$this->restore($idUser, 'Users', 'addWebBasic');                                            
					}
									
					$jsondata['success'] = false;
					$jsondata['data'] = 'El usuario ya existe con el id: ' . $row->id;
					
					$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'El usuario ya existe con el id: ' . $row->id);
				}
				else
				{
					$user = $this->Users->newEntity();
				
					$user->parent_user = 1;
					$user->username = $username;
					$user->password = $password;
					$user->type_of_identification = $_POST['typeOfIdentification'];
					$user->identidy_card = $_POST['identidyCard'];
					$user->role = 'Paciente';
					$user->first_name = $firstName;
					$user->second_name = '';
					$user->surname = $surname;
					$user->second_surname = '';
					$user->sex = $_POST['sex'];
					$user->email = $email;
					$user->cell_phone = $_POST['cellPhone'];
					$user->status = "ACTIVO";
					$user->date_status = $currentDate;
					$user->responsible_user = 'clnacional2017';
					
					if ($this->Users->save($user)) 
					{
						$lastRecord = $this->Users->find('all', ['conditions' => ['Users.username' => $username], 
							'order' => ['Users.created' => 'DESC']]);
				
						$row = $lastRecord->first();
					
						if ($row)
						{
							$idUser = $row->id;
							$jsondata['success'] = false;
							$jsondata['data'] = 'El usuario se creó con el id: ' . $row->id;
						}
					}
					else
					{
						if($user->errors())
						{
							$error_msg = $this->arrayErrors($user->errors());
						}
						else
						{
							$error_msg = ['Error desconocido'];
						}
						$jsondata['success'] = false;
						$jsondata['data'] = "No se pudo crear el usuario " . $user->username . ' debido a: ' . implode(" - ", $error_msg);
						foreach($error_msg as $noveltys)
						{
							$result = $binnacles->add('controller', 'Users', 'addWebBasic', $noveltys . 'username: ' . $user->username);
						}
					}
				}
			
				if (isset($idUser))
				{
					$idPatient = $patient->addWebPatient($idUser, $birthdate, $country, $address);

					if ($idPatient > 0)
					{
						$jsondata['success'] = true;
						$jsondata['data'] = 'El usuario y el paciente se crearon exitosamente';
						
						$arrayMail = [];

						$arrayResult = $service->searchService($surgery);

						if ($arrayResult['indicator'] == 0)
						{
							$arrayMail['mail'] = $email;
							$arrayMail['surgery'] = $surgery;
							$arrayMail['costBolivars'] = $arrayResult['costBolivars'];
							$arrayMail['costDollars'] = $arrayResult['costDollars'];
							$arrayMail['itemes'] = nl2br(htmlentities($arrayResult['itemes']));
							$itemesBudget = $arrayResult['itemes'];

							if ($country == 'VENEZUELA')
							{
								$arrayResult = $budget->addWebBudget($idPatient, $surgery, 'BOLIVAR', $arrayMail['costBolivars']);                            
							}
							else
							{
								$arrayResult = $budget->addWebBudget($idPatient, $surgery, 'DOLLAR', $arrayMail['costDollars']);                            
							}

							if($arrayResult['indicator'] == 0)
							{
								$jsondata['success'] = true;
								$jsondata['data'] = 'El usuario, el paciente y el presupuesto se crearon exitosamente';
							
								$arrayMail['subject'] = 'Presupuesto ' . $arrayResult['codeBudget']; 
								$arrayMail['firstName'] = $firstName;
								$arrayMail['surname'] = $surname;
								$arrayMail['identidy'] = $_POST['typeOfIdentification'] . '-' . $_POST['identidyCard'];
								$arrayMail['phone'] = $_POST['cellPhone'];
								$arrayMail['address'] = $address;
								$arrayMail['country'] = $country;
								$arrayMail['codeBudget'] = $arrayResult['codeBudget']; 
								$arrayMail['dateBudget'] = $arrayResult['dateBudget'];
								$arrayMail['expirationDate'] = $arrayResult['expirationDate'];						
								$arrayMail['namePromoter'] = 'Sitio web';
								$arrayMail['mailPromoter'] = 'angelomarsanz@gmail.com';
								$arrayMail['phonePromoter'] = '+58-0241-835-2284';
								
								$idBudget = $arrayResult['id'];
								
								$result = $iteme->add($idBudget, $itemesBudget);

								$result = $diarypatient->addWebDiary($idBudget);
		
								if ($result == 0)
								{
									$result = $this->mailBudget($arrayMail);
									$jsondata['success'] = true;
									$jsondata['data'] = 'El usuario, el paciente, presupuesto y agenda fueron creados exitosamente';
								}
								else
								{
									$jsondata['success'] = false;
									$jsondata['data'] = 'No se pudo crear la agenda del paciente';
									$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se pudo crear la agenda del paciente: ' . $user->username);
								}
							}
							else
							{
								$jsondata['success'] = false;
								$jsondata['data'] = 'No se pudo crear el presupuesto';
								$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se pudo crear el presupuesto del paciente id: ' . $idPatient);
							}
						}
						else
						{
							$jsondata['success'] = false;
							$jsondata['data'] = 'No se encontró el servicio';
							$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se encontró el servicio requerido por el paciente: ' . $user->username);
						}
					}
					else
					{
						$jsondata['success'] = false;
						$jsondata['data'] = 'No se pudo crear el paciente';
						$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se pudo crear el paciente: ' . $user->username);
					}
				}
			}
			else
			{
				$jsondata['success'] = false;
				$jsondata['data'] = 'Datos invalidados, no se pudieron crear registros en la base de datos';
				$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'Datos invalidados, no se pudieron crear registros en la base de datos');				
			}
			
            exit(json_encode($jsondata, JSON_FORCE_OBJECT));
        }        
    }
    
    public function mailBudget($arrayMail = null)
    {
		if (strtoupper($arrayMail['country']) == 'VENEZUELA') 
		{
			$varTotal = $arrayMail['costBolivars'];
		}
		else
		{
			$varTotal = $arrayMail['costDollars'];
		}
		
        $correo = new Email(); 
        $correo
		  ->transport('donWeb')
          ->template('email_budgets') 
          ->emailFormat('html') 
          ->to($arrayMail['mail']) 
		  ->cc($arrayMail['mailPromoter'])
		  ->bcc('publicidad.cirugiaslanacional@gmail.com')
          ->from(['noresponder@cirugiaslanacional.com' => 'Cirugías La Nacional']) 
          ->subject($arrayMail['subject'])
          ->viewVars([ 
            'varPatient' => $arrayMail['firstName'] . ' ' . $arrayMail['surname'],
            'varIdentidy' => $arrayMail['identidy'],
            'varPhone' => $arrayMail['phone'],
            'varAddress' => $arrayMail['address'],
            'varCountry' => $arrayMail['country'],
            'varId' => $arrayMail['codeBudget'],
            'varStartDate' => $arrayMail['dateBudget'],
            'varExpirationDate' => $arrayMail['expirationDate'],
            'varSurgery' => $arrayMail['surgery'],
            'varItemes' => $arrayMail['itemes'],
            'varTotal' => $varTotal,
			'varNamePromoter' => $arrayMail['namePromoter'],
			'varPhonePromoter' => $arrayMail['phonePromoter'],
			'varMailPromoter' => $arrayMail['mailPromoter']
          ]);
  
        $correo->SMTPAuth = true;
        $correo->CharSet = "utf-8";     

        if($correo->send())
        {
            $result = 0;
        }
        else
        {
            $result = 1;
        }

        return $result;
    }
    
/* Esta función es solo para pruebas de comunicación. Para pruebas se copia
	el contenido de la función addWebBasic y se suprime la línea $this->autoRender = false; */

    public function addWebBasicF()
    {	
		$binnacles = new BinnaclesController;

        $patient = new PatientsController;
        
        $budget = new BudgetsController;
        
        $diarypatient = new DiarypatientsController;
        
        $service = new ServicesController;
        
        $iteme = new ItemesController;

        if ($this->request->is('post')) 
        {
            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
            date_default_timezone_set('America/Caracas');

            $currentDate = time::now();

            $jsondata = [];
			
			$result = $this->validateFields($_POST);
			
			if ($result == 0)
            {
				$firstNameTrim = trim($_POST['firstName']);
				
				$firstName = strtoupper($firstNameTrim);

				$surnameTrim = trim($_POST['surname']);
				
				$surname = strtoupper($surnameTrim);
				
				$firstNameSurname = strtolower($firstName) . strtolower($surname);
				
				$users = TableRegistry::get('Users');
				
				$arrayResult = $users->find('username', ['firstname_surname' => $firstNameSurname]);
				
				if ($arrayResult['indicator'] == 0)
				{
					$consecutive = $arrayResult['searchRequired'] + 1;  
					
					$username = $firstNameSurname . $consecutive;
				}
				else 
				{
					$username = $firstNameSurname . '1';
				}
				
				$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
				
				$birthdate = $_POST['birthdate'];
						
				$countryTrim = trim($_POST['country']);
				
				$country = strtoupper($countryTrim);
		
				$addressTrim = trim($_POST['address']);
				
				$address = strtoupper($addressTrim);
				
				$surgeryTrim = trim($_POST['surgery']);
				
				$surgery = strtoupper($surgeryTrim);
				
				$emailTrim = trim($_POST['email']);
				
				$email = strtolower($emailTrim);
				
				$lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => 'Paciente'], ['Users.email' => $email]], 
					'order' => ['Users.created' => 'DESC']]);
				
				$row = $lastRecord->first();
					
				if ($row)
				{
					$idUser = $row->id;
					
					if ($row->user_status != 'ACTIVO' || $row->deleted_record == true)
					{
						$this->restore($idUser, 'Users', 'addWebBasic');                                            
					}
									
					$jsondata['success'] = false;
					$jsondata['data'] = 'El usuario ya existe con el id: ' . $row->id;
					
					$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'El usuario ya existe con el id: ' . $row->id);
				}
				else
				{
					$user = $this->Users->newEntity();
				
					$user->parent_user = 1;
					$user->username = $username;
					$user->password = $password;
					$user->type_of_identification = $_POST['typeOfIdentification'];
					$user->identidy_card = $_POST['identidyCard'];
					$user->role = 'Paciente';
					$user->first_name = $firstName;
					$user->second_name = '';
					$user->surname = $surname;
					$user->second_surname = '';
					$user->sex = $_POST['sex'];
					$user->email = $email;
					$user->cell_phone = $_POST['cellPhone'];
					$user->status = "ACTIVO";
					$user->date_status = $currentDate;
					$user->responsible_user = 'clnacional2017';
					
					if ($this->Users->save($user)) 
					{
						$lastRecord = $this->Users->find('all', ['conditions' => ['Users.username' => $username], 
							'order' => ['Users.created' => 'DESC']]);
				
						$row = $lastRecord->first();
					
						if ($row)
						{
							$idUser = $row->id;
							$jsondata['success'] = false;
							$jsondata['data'] = 'El usuario se creó con el id: ' . $row->id;
						}
					}
					else
					{
						if($user->errors())
						{
							$error_msg = $this->arrayErrors($user->errors());
						}
						else
						{
							$error_msg = ['Error desconocido'];
						}
						$jsondata['success'] = false;
						$jsondata['data'] = "No se pudo crear el usuario " . $user->username . ' debido a: ' . implode(" - ", $error_msg);
						foreach($error_msg as $noveltys)
						{
							$result = $binnacles->add('controller', 'Users', 'addWebBasic', $noveltys . 'username: ' . $user->username);
						}
					}
				}
			
				if (isset($idUser))
				{
					$idPatient = $patient->addWebPatient($idUser, $birthdate, $country, $address);

					if ($idPatient > 0)
					{
						$jsondata['success'] = true;
						$jsondata['data'] = 'El usuario y el paciente se crearon exitosamente';
						
						$arrayMail = [];

						$arrayResult = $service->searchService($surgery);

						if ($arrayResult['indicator'] == 0)
						{
							$arrayMail['mail'] = $email;
							$arrayMail['surgery'] = $surgery;
							$arrayMail['costBolivars'] = $arrayResult['costBolivars'];
							$arrayMail['costDollars'] = $arrayResult['costDollars'];
							$arrayMail['itemes'] = nl2br(htmlentities($arrayResult['itemes']));
							$itemesBudget = $arrayResult['itemes'];

							if ($country == 'VENEZUELA')
							{
								$arrayResult = $budget->addWebBudget($idPatient, $surgery, 'BOLIVAR', $arrayMail['costBolivars']);                            
							}
							else
							{
								$arrayResult = $budget->addWebBudget($idPatient, $surgery, 'DOLLAR', $arrayMail['costDollars']);                            
							}

							if($arrayResult['indicator'] == 0)
							{
								$jsondata['success'] = true;
								$jsondata['data'] = 'El usuario, el paciente y el presupuesto se crearon exitosamente';
							
								$arrayMail['subject'] = 'Presupuesto ' . $arrayResult['codeBudget']; 
								$arrayMail['firstName'] = $firstName;
								$arrayMail['surname'] = $surname;
								$arrayMail['identidy'] = $_POST['typeOfIdentification'] . '-' . $_POST['identidyCard'];
								$arrayMail['phone'] = $_POST['cellPhone'];
								$arrayMail['address'] = $address;
								$arrayMail['country'] = $country;
								$arrayMail['codeBudget'] = $arrayResult['codeBudget']; 
								$arrayMail['dateBudget'] = $arrayResult['dateBudget'];
								$arrayMail['expirationDate'] = $arrayResult['expirationDate'];						
								$arrayMail['namePromoter'] = 'Sitio web';
								$arrayMail['mailPromoter'] = 'angelomarsanz@gmail.com';
								$arrayMail['phonePromoter'] = '+58-0241-835-2284';
								
								$idBudget = $arrayResult['id'];
								
								$result = $iteme->add($idBudget, $itemesBudget);

								$result = $diarypatient->addWebDiary($idBudget);
		
								if ($result == 0)
								{
									$result = $this->mailBudget($arrayMail);
									$jsondata['success'] = true;
									$jsondata['data'] = 'El usuario, el paciente, presupuesto y agenda fueron creados exitosamente';
								}
								else
								{
									$jsondata['success'] = false;
									$jsondata['data'] = 'No se pudo crear la agenda del paciente';
									$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se pudo crear la agenda del paciente: ' . $user->username);
								}
							}
							else
							{
								$jsondata['success'] = false;
								$jsondata['data'] = 'No se pudo crear el presupuesto';
								$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se pudo crear el presupuesto del paciente id: ' . $idPatient);
							}
						}
						else
						{
							$jsondata['success'] = false;
							$jsondata['data'] = 'No se encontró el servicio';
							$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se encontró el servicio requerido por el paciente: ' . $user->username);
						}
					}
					else
					{
						$jsondata['success'] = false;
						$jsondata['data'] = 'No se pudo crear el paciente';
						$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'No se pudo crear el paciente: ' . $user->username);
					}
				}
			}
			else
			{
				$jsondata['success'] = false;
				$jsondata['data'] = 'Datos invalidados, no se pudieron crear registros en la base de datos';
				$result = $binnacles->add('controller', 'Users', 'addWebBasic', 'Datos invalidados, no se pudieron crear registros en la base de datos');				
			}
			
            exit(json_encode($jsondata, JSON_FORCE_OBJECT));
        }        
    }		

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $controller = null, $action = null)
    {
        $employee = new EmployeesController;
        	
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
		date_default_timezone_set('America/Caracas');

		$currentDate = time::now();

        $user = $this->Users->get($id, [
            'contain' => ['Employees']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $userPrevious = $this->Users->get($id, [
            'contain' => ['Employees', 'Patients']
            ]);

            $user = $this->Users->patchEntity($user, $this->request->data);
			
			$firstNameTrim = trim($user->first_name);
			
			$firstName = strtoupper($firstNameTrim);
			
			$secondNameTrim = trim($user->second_name);
			
			$secondName = strtoupper($secondNameTrim);
			
			$surnameTrim = trim($user->surname);
			
			$surname = strtoupper($surnameTrim);
			
			$secondSurnameTrim = trim($user->second_surname);
			
			$secondSurname = strtoupper($secondSurnameTrim);

			$emailTrim = trim($user->email);
	
			$email = strtolower($emailTrim);	
    
            $swUsername = 0;
            
            if ($userPrevious->username != $user->username)
            {
                $lastRecord = $this->Users->find('all', ['conditions' => ['Users.username' => $user->username], 
                    'order' => ['Users.created' => 'DESC']]);
            
                $row = $lastRecord->first();
                
                if ($row)
                {
                    if ($row->id != $id)
                    {
                        $swUsername = 1;
                    }
                }
            }
            
            if ($swUsername == 0)
            {
				$swEmail = 0;
				
				if ($userPrevious->email != $email)
				{
				    $lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => $user->role], ['Users.email' => $email]], 
                    'order' => ['Users.created' => 'DESC']]);
            
					$row = $lastRecord->first();
					
					if ($row)
					{
						if ($row->id != $id)
						{
							$swEmail = 1;
						}
					}
				}
				
				if ($swEmail == 0)
				{
					if ($this->Auth->user('username'))
					{
						$user->responsible_user = $this->Auth->user('username');
					}
					
					$user->first_name = $firstName;
					$user->second_name = $secondName;
					$user->surname = $surname;
					$user->second_surname = $secondSurname;
					$user->email = $email;
									
					if ($this->Users->save($user)) 
					{
						if ($userPrevious->email != $email)
						{
							$resultPromoter = 3;
							
							$result = $this->mailPromoter($email, $firstName, $user->username, $user->password, $resultPromoter);
						}
					
						if ($user->employees)
						{
							return $this->redirect(['controller' => 'Employees', 'action' => 'edit', $user->employees[0]['id'], 'Users', 'index']);
						}
						else
						{
							$this->Flash->success(__('Los datos se modificaron correctamente'));
							return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
						}
					}
					else
					{
						$this->Flash->error(__('Los datos no pudieron ser actualizados, intente nuevamente'));
					}
				}
				else
				{
				    $this->Flash->error(__('Ya existe un usuario registrado con este email: ' . $email));
				}
            }
            else
            {
                $this->Flash->error(__('Ya existe un usuario registrado como: ' . $user->username));
            }
        }
        $this->set(compact('user', 'controller', 'action'));
        $this->set('_serialize', ['user', 'controller', 'action']);
    }

    public function editBasic($id = null, $controller = null, $action = null, $idPromoter = null, $promoter = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Patients']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $swEmail = 0;
            
            if ($_POST['email'] != $user->email)
            {               
                $lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => 'Paciente'], ['Users.email' => $_POST['email']]], 
                    'order' => ['Users.created' => 'DESC']]);
            
                $row = $lastRecord->first();
                
                if ($row)
                {
                    if ($row->id != $id)
                    {
                        $swEmail = 1;
                    }
                }
            }

            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($swEmail == 1)
            {
                $this->Flash->error(__('Ya existe otro usuario registrado con el mismo email: ' . $row->email . '. ' . $row->surname . ' '. $row->first_name . ', por favor verifique el email'));
            }
            else
            {   
                if ($this->Auth->user('username'))
                {
                    $user->responsible_user = $this->Auth->user('username');
                }
    
                if ($this->Users->save($user)) 
                {
                    if ($user->patients)
                    {
                        return $this->redirect(['controller' => 'Patients', 'action' => 'edit', $user->patients[0]['id'], $controller, $action, $user->id, $idPromoter, $promoter]);
                    }
                }
                else
                {
                    $this->Flash->error(__('Los datos no pudieron ser actualizados, intente nuevamente'));
                }
            }
        }
        $this->set(compact('user', 'controller', 'action', 'idPromoter', 'promoter'));
        $this->set('_serialize', ['user', 'controller', 'action', 'idPromoter', 'promoter']);
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $controller = null, $action = null)
    {
        $employee = new EmployeesController;
              
        $this->request->allowMethod(['post', 'delete']);
        
        $user = $this->Users->get($id, [
            'contain' => ['Employees', 'Patients']]);

        $result = 0;

        if ($user->employees)
        {
            $result = $employee->delete($user->employees[0]['id']);
        }
        
		if ($result == 0)
        {
            $user->deleted_record = true;
            
            if ($this->Users->save($user)) 
            {
                $this->Flash->success(__('El usuario fue eliminado'));
            } 
            else 
            {
                $this->Flash->error(__('El usuario no pudo ser eliminado, intente nuevamente'));
            }                        
        }
        else
        {
            $this->Flash->error(__('El usuario no pudo ser eliminado, intente nuevamente'));
        }            

        return $this->redirect(['controller' => $controller, 'action' => $action]);
    }
    
    public function deleteBasic($id = null, $controller = null, $action = null)
    {
        $patient = new PatientsController;        
        
        $this->request->allowMethod(['post', 'delete']);
        
        $user = $this->Users->get($id, [
            'contain' => ['Patients']]);

        $user->deleted_record = true;
            
        if ($this->Users->save($user)) 
        {
            if ($user->patients)
            {
                $result = 0;
                
                $result = $patient->delete($user->patients[0]['id']); 
                
                if ($result == 0)
                {
                    $this->Flash->success(__('El paciente fue eliminado satisfactoriamente'));
                }
                else
                {
                    $this->Flash->error(__('El paciente no pudo ser eliminado, intente nuevamente'));
                }
            }
            else
            {
                $this->Flash->success(__('El paciente fue eliminado satisfactoriamente'));
            }
        }
        else
        {
            $this->Flash->error(__('El paciente no pudo ser eliminado, intente nuevamente'));
        } 
        
        return $this->redirect(['controller' => $controller, 'action' => $action]);
    }

    public function restore($id = null, $controller = null, $action = null)
    {
        $this->autoRender = false;
        
        $patient = new PatientsController;        
               
        $user = $this->Users->get($id, [
            'contain' => ['Patients']]);

        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = time::now();

        $user->user_status = 'ACTIVO';

        $user->reason_status = 'RESTAURACIÓN AUTOMÁTICA';

        $user->date_status = $currentDate;
        
        $user->deleted_record = null;            
            
        if ($action == 'addWebBasic')
        {
            $user->parent_user = 1;
        }
        else
        {
            $user->parent_user = $this->Auth->user('id');
        }
        
        if ($this->Users->save($user)) 
        {
            if ($user->patients)
            {
                $result = $patient->restore($user->patients[0]['id']); 
            }
        }
        else
        {
            $result = 1 ;
        } 
        
        if ($action == 'addWebBasic')
        {
            return $result;            
        }
        else
        {
            if ($result == 0)
            {
                $this->Flash->success(__('El paciente fue restaurado exitosamente'));
            }
            else
            {
                $this->Flash->error(__('El paciente no pudo ser restaurado'));
            }
            return $this->redirect(['controller' => $controller, 'action' => $action]);
        }
    }

    public function restoreUser($id = null, $controller = null, $action = null)
    {
        $this->autoRender = false;
		
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
		date_default_timezone_set('America/Caracas');

		$currentDate = time::now();
        
        $employee = new EmployeesController;
                      
        $user = $this->Users->get($id, [
            'contain' => ['Employees']]);
			
		$user->user_status = 'ACTIVO';

		$user->reason_status = 'REINCORPORACIÓN MANUAL';

		$user->date_status = $currentDate;
					
		$user->deleted_record = null;
		
		$firstNameTrim = trim($user->first_name);
		
		$firstName = strtoupper($firstNameTrim);
		
		$surnameTrim = trim($user->surname);
		
		$surname = strtoupper($surnameTrim);
		
		$emailTrim = trim($user->email);

		$email = strtolower($emailTrim);
							
		$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';
				
		$user->password = $password;  

		$user->parent_user = $this->Auth->user('id');			
		
		if ($this->Users->save($user))
		{
			$resultPromoter = 2;
						
			$result = $this->mailPromoter($email, $firstName, $user->username, $password, $resultPromoter);
            
            if ($user->employees)
            {
                $result = $employee->restore($user->employees[0]['id']);
            }

            if ($result == 0)
            {
                $this->Flash->success(__('El usuario fue restaurado satisfactoriamente'));
            } 
            else 
            {
                $this->Flash->error(__('El usuario no pudo ser restaurado, intente nuevamente'));
            }
        }
        else
        {
            $this->Flash->error(__('El usuario no pudo ser restaurado, intente nuevamente'));
        }
        return $this->redirect(['controller' => $controller, 'action' => $action]);
    }
    
    public function findPatient()
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            $name = $this->request->query['term'];
            $results = $this->Users->find('all', [
                'conditions' => [['surname LIKE' => $name . '%'], ['role' => 'Paciente'], ['OR' => [['Users.deleted_record IS NULL'], ['Users.deleted_record' => false]]]]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'], 'value' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'], 'id' => $result['id']];
            }
            
            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }

    public function previousUser()
    {
        
    }
    
    public function findUser()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            
            $name = $this->request->query['term'];
            $results = $this->Users->find('all', [
                'conditions' => [['Users.surname LIKE' => $name . '%'], ['OR' => [['Users.deleted_record IS NULL'], ['Users.deleted_record' => false]]]]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'] . ' - ' . $result['role'], 'value' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'] . ' - ' . $result['role'], 'id' => $result['id']];

            }

            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }

    public function findPromoter()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            
            $name = $this->request->query['term'];
            $results = $this->Users->find('all', [
                'conditions' => [['Users.surname LIKE' => $name . '%'], ['OR' => [['role' => 'Clinica'], ['role' => 'Coordinador(a)'], ['role' => 'Promotor(a)'], ['role' => 'Promotor(a) independiente'], ['role' => 'Call center']]], ['OR' => [['Users.deleted_record IS NULL'], ['Users.deleted_record' => false]]]]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'] . ' - ' . $result['role'], 'value' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'] . ' - ' . $result['role'], 'id' => $result['id']];

            }

            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }

    public function findPromoterMulti()
    {

        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            
            $name = $this->request->query['term'];
            $results = $this->Users->find('all', [
                'conditions' => [['Users.surname LIKE' => $name . '%'], ['OR' => [['role' => 'Promotor(a)'], ['role' => 'Promotor(a) independiente'], ['role' => 'Coordinador(a)'] ]]]]);
            $resultsArr = [];
            foreach ($results as $result) 
            {
                 $resultsArr[] = ['label' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'] . ' - ' . $result['role'], 'value' => $result['surname'] . ' ' . $result['second_surname'] . ' ' . $result['first_name'] . ' ' . $result['second_name'] . ' - ' . $result['role'], 'id' => $result['id']];

            }

            exit(json_encode($resultsArr, JSON_FORCE_OBJECT));
        }
    }

    public function reasignUser()
    {
        $this->autoRender = false;
        
        if ($this->request->is('post')) 
        {
            $idUser = $_POST['id1'];
            $idPatient = $_POST['id2'];
        }

        $user = $this->Users->get($idPatient);
        
        $user->parent_user = $idUser;
        
        if ($this->Users->save($user)) 
        {
            $this->Flash->success(__('El paciente fue reasignado satisfactoriamente'));
        }
        else
        {
            $this->Flash->error(__('El paciente no pudo ser eliminado, intente nuevamente'));

        }
        return $this->redirect(['controller' => 'Diarypatients', 'action' => 'index']);
    }
    public function formComunication()
    {
        
    }
    public function checkUser()
    {
        $this->autoRender = false;
         
        if ($this->request->is('json'))
        {
            $jsondata = [];

            if (isset($_POST['role']) && isset($_POST['email']))
            {               
                $emailTrim = trim($_POST['email']);
		
				$email = strtolower($emailTrim);
                
                $lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => $_POST['role']], ['Users.email' => $email]], 
                    'order' => ['Users.created' => 'DESC']]);
            
                $row = $lastRecord->first();
                
                if ($row)
                {        
                    $jsondata["success"] = true;
                    $jsondata["data"]["message"] = "Usuario ya está registrado en BD";
                    $jsondata["data"]['id'] = $row->id;
                    $jsondata["data"]['surname'] = $row->surname;
                    $jsondata["data"]['firstName'] = $row->first_name;
                    if ($row->deleted_record == null)
                    {
                        $jsondata['data']['status'] = "ACTIVO";
                    }
                    else
                    {
                        $jsondata['data']['status'] = "ELIMINADO";
                    }
                }
                else
                {
                    $jsondata["success"] = false;
                    $jsondata["data"]["message"] = "Usuario no está registrado en BD";
                }
                exit(json_encode($jsondata, JSON_FORCE_OBJECT));
            }
            else
            {
                die("Solicitud no válida.");
            }
        }
    }

    public function viewGlobal($id = null, $controller = null, $action = null, $idPromoter = null)
    {
		$this->loadModel('Systems');

		$system = $this->Systems->get(2);
	
        if ($this->request->is('post'))
        {
            $id = $_POST['id'];
            if (isset($_POST['status']))
            {
                $this->Flash->error(__('Este paciente ya está registrado en la Base de Datos. Por favor verifique...'));    
            }
            $controller = $_POST['controller'];
            $action = $_POST['action'];
        }            

        $user = $this->Users->get($id, [
            'contain' => ['Patients' => ['Budgets' =>['Diarypatients']]]]);
			
		if (!(isset($idPromoter)))
		{
			$idPromoter = $this->Auth->user('id');
		}

        $promoter = $this->Users->get($user->parent_user);
        
        $currentView = 'usersViewGlobal';
		
		$this->loadModel('Services');		
		
		$services = $this->Services->find('list', ['limit' => 200, 'conditions' => [['Services.registration_status' => 'ACTIVO'], ['OR' => [['Services.cost_bolivars >' => 0], ['Services.cost_dollars >' => 0]]]], 'order' => ['Services.service_description' => 'ASC']]);

        $this->set('user', $user);
        $this->set('promoter', $promoter);
        $this->set(compact('id', 'controller', 'action', 'currentView', 'idPromoter', 'services', 'system'));
        $this->set('_serialize', ['user', 'promoter', 'id', 'controller', 'action', 'currentView', 'idPromoter', 'services', 'system']);
    }
    public function confirmPatient($id = null, $controller = null, $action = null)
    {
        if ($this->request->is('post'))
        {
            $id = $_POST['id'];
            $controller = $_POST['controller'];
            $action = $_POST['action'];
            $namePatient = $_POST['name'];
            $currentView = 'usersConfirmPatient';
            
        $this->set(compact('id', 'controller', 'action', 'currentView', 'namePatient'));
        $this->set('_serialize', ['id', 'controller', 'action', 'currentView', 'namePatient']);
        }
    }

    public function confirmUser($id = null, $controller = null, $action = null)
    {
        if ($this->request->is('post'))
        {
            $id = $_POST['id'];
            $controller = $_POST['controller'];
            $action = $_POST['action'];
            $nameUser = $_POST['name'];
            $currentView = 'usersConfirmUser';
            
        $this->set(compact('id', 'controller', 'action', 'currentView', 'nameUser'));
        $this->set('_serialize', ['id', 'controller', 'action', 'currentView', 'nameUser']);
        }
    }
    
    public function wait()
    {
        
    }
    public function recoverPassword()
    {      	       	
		setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
		date_default_timezone_set('America/Caracas');

		$currentDate = time::now();

        $user = $this->Users->newEntity();
		
        if ($this->request->is('post')) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
					
			$emailTrim = trim($user->email);
	
			$email = strtolower($emailTrim);
		
			$lastRecord = $this->Users->find('all', ['conditions' => [['Users.role' => $user->role], ['Users.email' => $email]], 
			'order' => ['Users.created' => 'DESC']]);
	
			$row = $lastRecord->first();
			
			if ($row)
			{
				$user = $this->Users->get($row->id);
			
				$firstNameTrim = trim($user->first_name);
				
				$firstName = strtoupper($firstNameTrim);
				
				$surnameTrim = trim($user->surname);
				
				$surname = strtoupper($surnameTrim);
			
				$password = substr($firstName, 0, 1) . substr($surname, 0, 1) . $currentDate->second . $currentDate->minute . '$';

				$user->password = $password;
							
				if ($this->Users->save($user)) 
				{					
					$result = $this->mailRecoverPassword($email, $firstName, $user->username, $password);
			
					if ($result == 0)
					{
						$this->Flash->success(__('Se envió el usuario y contraseña al email: ' . $email));
					}
					else
					{
						$this->Flash->error(__('No se pudo enviar el email con su usuario y contraseña. Por favor intente nuevamente'));
					}
				}
				else
				{
					$this->Flash->error(__('No se pudo crear la nueva contraseña. Por favor intente nuevamente'));
				}			
			}
			else
			{
				$this->Flash->error(__('No se encontró ningún usuario registrado con ese email'));
			}	
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}	
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    public function mailRecoverPassword($email = null, $firstName = null, $username = null, $password = null)
    {
        $correo = new Email(); 
        $correo
          ->transport('donWeb')
          ->template('email_password') 
          ->emailFormat('html') 
          ->to($email) 
          ->from(['noresponder@cirugiaslanacional.com' => 'Cirugías La Nacional']) 
          ->subject('Recuperación de usuario y contraseña') 
          ->viewVars([ 
            'varPromoter' => $firstName,
            'varUsername' => $username,
            'varPassword' => $password,
          ]);
		  
        $correo->SMTPAuth = true;
        $correo->CharSet = "utf-8";     

        if($correo->send())
        {
            $result = 0;
        }
        else
        {
            $result = 1;
        }
        
        return $result;
    }
    public function mailBudgetTest($arrayMail = null)
    {
        $correo = new Email(); 
        $correo
		  ->transport('donWeb')
          ->template('email_budgets_test') 
          ->emailFormat('html') 
          ->to($arrayMail['mail']) 
		  ->cc($arrayMail['mailPromoter'])
//		  ->bcc('publicidad.cirugiaslanacional@gmail.com')
          ->from(['noresponder@cirugiaslanacional.com' => 'Cirugías La Nacional']) 
          ->subject($arrayMail['subject'])
          ->viewVars([ 
            'varPatient' => $arrayMail['firstName'] . ' ' . $arrayMail['surname'],
            'varIdentidy' => $arrayMail['identidy'],
            'varPhone' => $arrayMail['phone'],
            'varAddress' => $arrayMail['address'],
            'varCountry' => $arrayMail['country'],
            'varId' => $arrayMail['codeBudget'],
            'varStartDate' => $arrayMail['dateBudget'],
            'varExpirationDate' => $arrayMail['expirationDate'],
            'varSurgery' => $arrayMail['surgery'],
            'varItemes' => $arrayMail['itemes'],
            'varTotal' => $arrayMail['costBolivars'],
			'varNamePromoter' => $arrayMail['namePromoter'],
			'varPhonePromoter' => $arrayMail['phonePromoter'],
			'varMailPromoter' => $arrayMail['mailPromoter']
          ]);
  
        $correo->SMTPAuth = true;
        $correo->CharSet = "utf-8";     

        if($correo->send())
        {
            $result = 0;
        }
        else
        {
            $result = 1;
        }

        return $result;
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
	public function removePromotersTest()
	{
		$binnacles = new BinnaclesController;

		$arrayPromoters = [361, 1296, 1297]; // Escribir el id del promotor a eliminar
			
		foreach ($arrayPromoters as $arrayPromoter)
		{	
			try 
			{
				$swError = 0;
				
				$userG = $this->Users->get($arrayPromoter);

				$lastRecord = $this->Users->Employees->find('all')
					->where(['Employees.user_id' => $userG->id])
					->order(['Employees.created' => 'DESC']);

				$employee = $lastRecord->first();
			
				if ($employee)
				{
					$employeeG = $this->Users->Employees->get($employee->id);
					
					if (!($this->Users->Employees->delete($employeeG))) 
					{
						if($employeeG->errors())
						{
							$error_msg = $this->arrayErrors($employeeG->errors());
						}
						else
						{
							$error_msg = ['Error desconocido'];
						}
						foreach($error_msg as $noveltys)
						{
							$result = $binnacles->add('controller', 'Users', 'removePromotersTest', $noveltys . ' empleado: ' . $employee->id);
						}		
						$this->Flash->error(__('No se pudo eliminar el empleado ' . $employee->id . ' debido a: ' . implode(' - ', $error_msg)));
						$swError = 1;
					}
				}
				
				$childrens = $this->Users->find('all')->where
					(['Users.parent_user' => $userG->id]);
					
				foreach ($childrens as $children)
				{
					if ($children->role == 'Paciente')
					{
						$swErrorPatient = $this->removePatientsTest($children->id);
						if ($swErrorPatient == 1)
						{
							$swError = $swErrorPatient;
						}
					}
					else
					{
						$swErrorSon = $this->removeSonTest($children->id);
						if ($swErrorSon == 1)
						{
							$swError = $swErrorSon;
						}
					}
				}
				
				if (!($this->Users->delete($userG))) 
				{
					if($userG->errors())
					{
						$error_msg = $this->arrayErrors($userG->errors());
					}
					else
					{
						$error_msg = ['Error desconocido'];
					}
					foreach($error_msg as $noveltys)
					{
						$result = $binnacles->add('controller', 'Users', 'removePromotersTest', $noveltys . ' usuario-promotor: ' . $userG->id);
					}		
					$this->Flash->error(__('No se pudo eliminar el usuario-promotor ' . $userG->id . ' debido a: ' . implode(' - ', $error_msg)));
					$swError = 1;
				}	
				if ($swError == 0)
				{
					$this->Flash->success(__('El usuario-promotor ' . $userG->id . ' y todas sus dependencias fueron eliminadas satisfactoriamente'));
				}
			} 
			catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) 
			{
				$this->Flash->error(__('Usuario-promotor no existe: ' . $arrayPromoter));
				$result = $binnacles->add('controller', 'Users', 'removePromotersTest', 'No existe el usuario-promotor: ' . $arrayPromoter);
				$swError = 1;
			}		
		}
		return;
	}
	
	public function removeSonTest($idSon = null)
	{
		$binnacles = new BinnaclesController;

		$arrayPromoters = [$idSon];
			
		foreach ($arrayPromoters as $arrayPromoter)
		{	
			try 
			{
				$swError = 0;
				
				$userG = $this->Users->get($arrayPromoter);

				$lastRecord = $this->Users->Employees->find('all')
					->where(['Employees.user_id' => $userG->id])
					->order(['Employees.created' => 'DESC']);

				$employee = $lastRecord->first();
			
				if ($employee)
				{
					$employeeG = $this->Users->Employees->get($employee->id);
					
					if (!($this->Users->Employees->delete($employeeG))) 
					{
						if($employeeG->errors())
						{
							$error_msg = $this->arrayErrors($employeeG->errors());
						}
						else
						{
							$error_msg = ['Error desconocido'];
						}
						foreach($error_msg as $noveltys)
						{
							$result = $binnacles->add('controller', 'Users', 'removeSonTest', $noveltys . ' empleado: ' . $employee->id);
						}		
						$this->Flash->error(__('No se pudo eliminar el empleado ' . $employee->id . ' debido a: ' . implode(' - ', $error_msg)));
						$swError = 1;
					}
				}
				
				$childrens = $this->Users->find('all')->where
					(['Users.parent_user' => $userG->id]);
					
				foreach ($childrens as $children)
				{
					if ($children->role == 'Paciente')
					{
						$swErrorPatient = $this->removePatientsTest($children->id);
						if ($swErrorPatient == 1)
						{
							$swError = $swErrorPatient;
						}
					}
					else
					{
						$swErrorGrandchild = $this->removeGrandchildTest($children->id);
						if ($swErrorGrandchild == 1)
						{
							$swError = $swErrorGrandchild;
						}
					}
				}
				
				if (!($this->Users->delete($userG))) 
				{
					if($userG->errors())
					{
						$error_msg = $this->arrayErrors($userG->errors());
					}
					else
					{
						$error_msg = ['Error desconocido'];
					}
					foreach($error_msg as $noveltys)
					{
						$result = $binnacles->add('controller', 'Users', 'removeSonTest', $noveltys . ' usuario-hijo: ' . $userG->id);
					}		
					$this->Flash->error(__('No se pudo eliminar el usuario-hijo ' . $userG->id . ' debido a: ' . implode(' - ', $error_msg)));
					$swError = 1;
				}	
				if ($swError == 0)
				{
					$this->Flash->success(__('El usuario-hijo ' . $userG->id . ' y todas sus dependencias fueron eliminadas satisfactoriamente'));
				}
			} 
			catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) 
			{
				$this->Flash->error(__('Usuario-hijo no existe: ' . $arrayPromoter));
				$result = $binnacles->add('controller', 'Users', 'removeSonTest', 'No existe el usuario-hijo: ' . $arrayPromoter);
				$swError = 1;
			}		
		}
		return $swError;
	}
	
	public function removeGrandChildTest($idGrandchild = null)
	{
		$binnacles = new BinnaclesController;
	
		$arrayPromoters = [$idGrandchild];
			
		foreach ($arrayPromoters as $arrayPromoter)
		{	
			try 
			{
				$swError = 0;
				
				$userG = $this->Users->get($arrayPromoter);

				$lastRecord = $this->Users->Employees->find('all')
					->where(['Employees.user_id' => $userG->id])
					->order(['Employees.created' => 'DESC']);

				$employee = $lastRecord->first();
			
				if ($employee)
				{
					$employeeG = $this->Users->Employees->get($employee->id);
					
					if (!($this->Users->Employees->delete($employeeG))) 
					{
						if($employeeG->errors())
						{
							$error_msg = $this->arrayErrors($employeeG->errors());
						}
						else
						{
							$error_msg = ['Error desconocido'];
						}
						foreach($error_msg as $noveltys)
						{
							$result = $binnacles->add('controller', 'Users', 'removeGrandchildTest', $noveltys . ' empleado: ' . $employee->id);
						}		
						$this->Flash->error(__('No se pudo eliminar el empleado ' . $employee->id . ' debido a: ' . implode(' - ', $error_msg)));
						$swError = 1;
					}
				}
				
				$childrens = $this->Users->find('all')->where
					(['Users.parent_user' => $userG->id]);
					
				foreach ($childrens as $children)
				{
					if ($children->role == 'Paciente')
					{
						$swErrorPatient = $this->removePatientsTest($children->id);
						if ($swErrorPatient == 1)
						{
							$swError = $swErrorPatient;
						}
					}
				}
				
				if (!($this->Users->delete($userG))) 
				{
					if($userG->errors())
					{
						$error_msg = $this->arrayErrors($userG->errors());
					}
					else
					{
						$error_msg = ['Error desconocido'];
					}
					foreach($error_msg as $noveltys)
					{
						$result = $binnacles->add('controller', 'Users', 'removeGrandchildTest', $noveltys . ' usuario-promotor: ' . $userG->id);
					}		
					$this->Flash->error(__('No se pudo eliminar el usuario-nieto ' . $userG->id . ' debido a: ' . implode(' - ', $error_msg)));
					$swError = 1;
				}	
				if ($swError == 0)
				{
					$this->Flash->success(__('El usuario-nieto ' . $userG->id . ' y todas sus dependencias fueron eliminadas satisfactoriamente'));
				}
			} 
			catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) 
			{
				$this->Flash->error(__('Usuario-nieto no existe: ' . $arrayPromoter));
				$result = $binnacles->add('controller', 'Users', 'removeGrandchildTest', 'No existe el usuario-nieto: ' . $arrayPromoter);
				$swError = 1;
			}		
		}
		return $swError;
	}

	public function removePatientsTest($requiredUser = null)
	{
		$binnacles = new BinnaclesController;

		if (isset($requiredUser))
		{
			$arrayPatients = [$requiredUser];
		}
		else
		{
			$arrayPatients = [1389, 1390]; // Escribir los id de los pacientes a eliminar  
		}
			
		foreach ($arrayPatients as $arrayPatient)
		{	
			try 
			{
				$swError = 0;
				
				$userG = $this->Users->get($arrayPatient);

				$patients = $this->Users->Patients->find('all')
					->where(['Patients.user_id' => $userG->id]);
		
				foreach ($patients as $patient)
				{
					$patientG = $this->Users->Patients->get($patient->id);
					
					$budgets = $this->Users->Patients->Budgets->find('all')->where
						(['Budgets.patient_id' => $patient->id]);
						
					foreach ($budgets as $budget)
					{
						$budgetG = $this->Users->Patients->Budgets->get($budget->id);
						
						$itemes = $this->Users->Patients->Budgets->Itemes->find('all')->where
						(['Itemes.Budget_id' => $budget->id]);
						
						foreach ($itemes as $iteme)
						{
							$itemeG = $this->Users->Patients->Budgets->Itemes->get($iteme->id);
							
							if (!($this->Users->Patients->Budgets->Itemes->delete($itemeG))) 
							{
								if($itemeG->errors())
								{
									$error_msg = $this->arrayErrors($itemeG->errors());
								}
								else
								{
									$error_msg = ['Error desconocido'];
								}
								foreach($error_msg as $noveltys)
								{
									$result = $binnacles->add('controller', 'Users', 'removePatientsTest', $noveltys . ' item: ' . $iteme->id);
								}		
								$this->Flash->error(__('No se pudo eliminar el item ' . $iteme->id . ' debido a: ' . implode(' - ', $error_msg)));
								$swError = 1;
							}
						}
						
						$diarypatients = $this->Users->Patients->Budgets->Diarypatients->find('all')->where
						(['Diarypatients.Budget_id' => $budget->id]);
						
						foreach ($diarypatients as $diarypatient)
						{
							$diarypatientG = $this->Users->Patients->Budgets->Diarypatients->get($diarypatient->id);
							
							if (!($this->Users->Patients->Budgets->Diarypatients->delete($diarypatientG))) 
							{
								if($diarypatientG->errors())
								{
									$error_msg = $this->arrayErrors($diarypatientG->errors());
								}
								else
								{
									$error_msg = ['Error desconocido'];
								}
								foreach($error_msg as $noveltys)
								{
									$result = $binnacles->add('controller', 'Users', 'removePatientsTest', $noveltys . ' actividad: ' . $diarypatient->id);
								}		
								$this->Flash->error(__('No se pudo eliminar la actividad ' . $diarypatient->id . ' debido a: ' . implode(' - ', $error_msg)));
								$swError = 1;
							}
						}
						if (!($this->Users->Patients->Budgets->delete($budgetG))) 
						{
							if($budgetG->errors())
							{
								$error_msg = $this->arrayErrors($budgetG->errors());
							}
							else
							{
								$error_msg = ['Error desconocido'];
							}
							foreach($error_msg as $noveltys)
							{
								$result = $binnacles->add('controller', 'Users', 'removePatientsTest', $noveltys . ' presupuesto: ' . $budget->id);
							}		
							$this->Flash->error(__('No se pudo eliminar el presupuesto' . $budget->id . ' debido a: ' . implode(' - ', $error_msg)));
							$swError = 1;
						}
					}
					if (!($this->Users->Patients->delete($patientG))) 
					{
						if($patientG->errors())
						{
							$error_msg = $this->arrayErrors($patientG->errors());
						}
						else
						{
							$error_msg = ['Error desconocido'];
						}
						foreach($error_msg as $noveltys)
						{
							$result = $binnacles->add('controller', 'Users', 'removePatientsTest', $noveltys . ' paciente: ' . $patient->id);
						}		
						$this->Flash->error(__('No se pudo eliminar el paciente ' . $patient->id . ' debido a: ' . implode(' - ', $error_msg)));
						$swError = 1;
					}						
				}
				if (!($this->Users->delete($userG))) 
				{
					if($userG->errors())
					{
						$error_msg = $this->arrayErrors($userG->errors());
					}
					else
					{
						$error_msg = ['Error desconocido'];
					}
					foreach($error_msg as $noveltys)
					{
						$result = $binnacles->add('controller', 'Users', 'removePatientsTest', $noveltys . ' usuario-paciente: ' . $userG->id);
					}		
					$this->Flash->error(__('No se pudo eliminar el usuario-paciente ' . $userG->id . ' debido a: ' . implode(' - ', $error_msg)));
					$swError = 1;
				}	
				if ($swError == 0)
				{
					$this->Flash->success(__('El usuario-paciente ' . $userG->id . ' y todas sus dependencias fueron eliminadas satisfactoriamente'));
				}
			} 
			catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) 
			{
				$this->Flash->error(__('Usuario-paciente no existe: ' . $arrayPatient));
				$result = $binnacles->add('controller', 'Users', 'removePatientsTest', 'No existe el usuario-paciente: ' . $arrayPatient);
				$swError = 1;
			}		
		}
		if (isset($requiredUser))
		{
			return $swError;
		}
		else
		{
			return;
		}
	}
	public function validateFields($rFields = null)
	{
		$this->autoRender = false;
	
		$binnacles = new BinnaclesController;
	
		$result = 0;
		
		if (isset($rFields['typeOfIdentification']))
		{
			if ($rFields['typeOfIdentification'] == '')
			{
				$result = 1;
			}		
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['identidyCard']))
		{
			if ($rFields['identidyCard'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['firstName']))
		{
			if ($rFields['firstName'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['surname']))
		{
			if ($rFields['surname'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['sex']))
		{
			if ($rFields['sex'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		$binnacles->add('controller', 'Users', 'validateFields', $rFields['birthdate']);
		
		if (isset($rFields['birthdate']))
		{
			$resultDate = $this->validateDate($rFields['birthdate']);
			
			if ($resultDate == 1)
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		$numberP = '/^([0-9]{1})$/';  
		
		if (isset($rFields['cellPhone']))
		{
			if (substr($rFields['cellPhone'], 0, 1) == '(')
			{
				if (!(preg_match($numberP, substr($rFields['cellPhone'], 1, 1)))) 
				{
					$result = 1;
				}
			}
			elseif (!(preg_match($numberP, substr($rFields['cellPhone'], 0, 1)))) 
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['email']))
		{			
			$emailTrim = trim($rFields['email']);
				
			$email = strtolower($emailTrim);
	
			if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) 
			{
				$result = 1;
			}
		}
		
		if (isset($rFields['country']))
		{
			if ($rFields['country'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['address']))
		{
			if ($rFields['address'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['surgery']))
		{
			if ($rFields['surgery'] == '')
			{
				$result = 1;
			}
		}
		else
		{
			$result = 1;
		}
		
		if (isset($rFields['coin']))
		{
			if ($rFields['coin'] == '')
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
	public function validateDate($birthdate = null)
	{
		$this->autoRender = false;		

		$eBirthdate = explode('-', $birthdate);
		
		if (count($eBirthdate) == 3)
		{
			if ($eBirthdate[0] > 0)
			{
				if ($eBirthdate[1] > 0 && $eBirthdate[1] < 13)
				{
					if ($eBirthdate[2] > 0 && $eBirthdate[2] < 32)
					{
						return 0;
					}			
				}
			}
		}
		return 1;
	}
}
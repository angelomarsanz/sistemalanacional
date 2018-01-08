<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\EmployeesController;

use App\Controller\MultilevelsController;

use App\Controller\PatientsController;

use App\Controller\BudgetsController;

use Cake\I18n\Time;

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
    }

    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] == 'Auditor(a) externo' || $user['role'] == 'Auditor(a) interno' || $user['role'] == 'Coordinador(a)' )
            {
                if(in_array($this->request->action, ['home', 'previousUser', 'findUser', 'findPatient', 'findPromoter', 'add', 'addBasic', 'index', 'indexPatientUser', 'indexBasic', 'view', 'viewBasic', 'edit', 'editBasic', 'delete', 'deleteBasic', 'logout', 'reasignUser']))
                {
                    return true;
                }
            }  
            elseif ($user['role'] === 'Promotor(a)' || $user['role'] === 'Promotor(a) independiente')
            {
                if(in_array($this->request->action, ['findPatient', 'home', 'addBasic', 'indexPatientUser', 'view', 'viewBasic', 'editBasic', 'delete', 'deleteBasic', 'logout']))
                {
                    return true;
                }                
            }
            elseif ($user['role'] === 'Call center')
            {
                if(in_array($this->request->action, ['home', 'addBasic', 'indexPatientUser', 'view', 'viewBasic', 'editBasic', 'delete', 'deleteBasic', 'logout']))
                {
                    return true;
                }                
            }
        }
        return parent::isAuthorized($user);
    }        

    public function testFunction()
    {

        $servername = "localhost";
        $username = "clinica_web";
        $password = "";
        $dbname = "clinica_sitio";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        else
        {
            echo "Connected successfully";
/*                
            $sql = "SELECT campotabla FROM mitabla";
            $result = $conn->query($sql);
            
            $contador = 0;
            
            if ($result)
            {
                foreach ($result as $results)
                {
                    echo " campotabla: " . $results['campotabla']. "<br>";
                    if ($contador > 5)
                    {
                        break;
                    }
                    $contador++;
                }
            } 
            else 
            {
                echo "0 results";
            }
*/
            $conn->close();
        }
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

                return $this->redirect($this->Auth->redirectUrl());
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
            [['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]]]);

        $this->set('users', $this->paginate($query));
        
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function indexPatientUser()
    {
        $query = $this->Users->find('all')->where
            ([['Users.parent_user' => $this->Auth->user('id')],
            ['Users.role' => 'Paciente'],
            [['OR' => ['Users.deleted_record IS NULL', 'Users.deleted_record' => false]]]]);

        $this->set('users', $this->paginate($query));
        
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
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
    public function view($id = null, $origin = null)
    {
        if ($this->request->is('post')) 
        {
            $id = $_POST['idUser'];
            $origin = $_POST['origin'];
        }
        $user = $this->Users->get($id, [
            'contain' => ['Multilevels', 'Employees', 'Patients']]);
            
        $query = $this->Users->find('all')->where([['Users.parent_user' => $id], 
                    ['Users.role' => 'Paciente']]);
            
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $this->set(compact('origin', 'query'));
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
    public function add($origin = null)
    {
        $employee = new EmployeesController;
        
        $multilevel = new MultilevelsController;

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($user->role == 'Promotor(a) independiente')
            {
                $user->username = 'PR' . $user->type_of_identification . $user->identidy_card;
                $user->password = 'PR' . $user->type_of_identification . $user->identidy_card;
            }
            else
            {
                $user->username = 'EM' . $user->type_of_identification . $user->identidy_card;
                $user->password = 'EM' . $user->type_of_identification . $user->identidy_card;
            }

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
            }
            
            if ($this->Users->save($user)) 
            {
                $query = $this->Users->find('all')->where(['Users.username' => $user->username], 
                    ['Users.responsible_user' => $this->Auth->user('username')]);
                    
                $arrayUser = $query->toArray();
                
                $result = 0;
                
                if ($user->role == 'Promotor(a) independiente')
                {
                    $result = $multilevel->addAutomatic($arrayUser[0]['id']);
                }
                else
                {
                    $result = $employee->addAutomatic($arrayUser[0]['id']);
                }
                if ($result == 1)
                {
                    if ($this->Auth->user('username'))
                    {
                        $this->Flash->success(__('El usuario se creo exitosamente'));
                        return $this->redirect(['action' => 'index']); 
                    }
                    else
                    {
                        $this->Flash->success(__('Los datos se guardaron correctamente, por favor escriba su usuario, la contraseña y pulsa el botón ACCEDER'));
                        return $this->redirect(['action' => 'login']);                      
                    }
                }
                else
                {
                    $this->Flash->error(__('Los datos de usuario no se guardaron, por favor intente nuevamente'));
                }
            }
            else
            {
                $this->Flash->error(__('Los datos de usuario no se guardaron en la tabla user, por favor intente nuevamente'));    
            }
        }
        
        $this->set(compact('user', 'origin'));
        $this->set('_serialize', ['user', 'origin']);
    }
    public function addBasic($origin = null)
    {
        $patient = new PatientsController;
        
        $budget = new BudgetsController;
        
        $diarypatient = new DiarypatientsController;
        
        if ($this->request->is('post')) 
        {
            $user = $this->Users->newEntity();
            
            $user->username = 'PA' . $_POST['type_of_identification'] . $_POST['identidy_card'];
            $user->password = 'PA' . $_POST['type_of_identification'] . $_POST['identidy_card'];
            $user->type_of_identification = $_POST['type_of_identification'];
            $user->identidy_card = $_POST['identidy_card'];
            $user->role = $_POST['role'];
            $user->first_name = $_POST['first_name'];
            $user->surname = $_POST['surname'];
            $user->sex = $_POST['sex'];
            $user->email = $_POST['email'];
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
                $user->responsible_user = $this->Auth->user('username');
            }

            $dateBirthDate = $_POST['birthdate']['year'] . '-' .  $_POST['birthdate']['month'] . '-' . $_POST['birthdate']['day'];
        
            $dateBirthDateConverted = new Time($dateBirthDate);
            
            if ($this->Users->save($user)) 
            {
                $query = $this->Users->find('all')->where(['Users.username' => $user->username], 
                    ['Users.responsible_user' => $this->Auth->user('username')]);
                    
                $arrayUser = $query->toArray();
                
                $idPatient = $patient->addAutomatic($arrayUser[0]['id']);

                if ($idPatient > 0)
                {
                    $idBudget = $budget->addAutomatic($idPatient);
                    
                    if($idBudget > 0)
                    {
                        $result = 0;
                        
                        $result = $diarypatient->addAutomatic($idBudget);
                    
                        if ($result > 0)
                        {
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
        
            if ($origin == null)
            {
                return $this->redirect(['action' => 'home']);
            }
            else
            {
                return $this->redirect(['controller' =>  'Users', 'action' => $origin]); 
            }
        }

        $this->set(compact('origin'));

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Employees', 'Multilevels', 'Patients']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($user->role == 'Promotor(a) independiente')
            {
                $user->username = 'PR' . $user->type_of_identification . $user->identidy_card;
                $user->password = 'PR' . $user->type_of_identification . $user->identidy_card;
            }
            else
            {
                $user->username = 'EM' . $user->type_of_identification . $user->identidy_card;
                $user->password = 'EM' . $user->type_of_identification . $user->identidy_card;
            }
            
            if ($this->Auth->user('username'))
            {
                $user->responsible_user = $this->Auth->user('username');
            }

            if ($this->Users->save($user)) 
            {
                if ($user->multilevels)
                {
                    return $this->redirect(['controller' => 'Multilevels', 'action' => 'edit', $user->multilevels[0]['id']]);
                }
                elseif ($user->employees)
                {
                    return $this->redirect(['controller' => 'Employees', 'action' => 'edit', $user->employees[0]['id']]);
                }
            }
            else
            {
                $this->Flash->error(__('Los datos no pudieron ser actualizados, intente nuevamente'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function editBasic($id = null, $origin = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Patients']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            $user->username = 'PA' . $user->type_of_identification . $user->identidy_card;
            $user->password = 'PA' . $user->type_of_identification . $user->identidy_card;

            if ($this->Auth->user('username'))
            {
                $user->responsible_user = $this->Auth->user('username');
            }

            if ($this->Users->save($user)) 
            {
                if ($user->patients)
                {
                    return $this->redirect(['controller' => 'Patients', 'action' => 'edit', $user->patients[0]['id'], $origin]);
                }

            }
            else
            {
                $this->Flash->error(__('Los datos no pudieron ser actualizados, intente nuevamente'));
            }
        }
        $this->set(compact('user', 'origin'));
        $this->set('_serialize', ['user', 'origin']);
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $origin = null)
    {
        $employee = new EmployeesController;
        
        $multilevel = new MultilevelsController;
        
        $this->request->allowMethod(['post', 'delete']);
        
        $user = $this->Users->get($id, [
            'contain' => ['Multilevels', 'Employees', 'Patients']]);

        $result = 0;

        if ($user->multilevels)
        {
            $result = $multilevel->delete($user->multilevels[0]['id']);
        } 
        elseif ($user->employees)
        {
            $result = $employee->delete($user->employees[0]['id']);
        }
        if ($result == 1)
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

        return $this->redirect(['action' => $origin]);
    }
    
    public function deleteBasic($id = null, $origin = null)
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
        
        return $this->redirect(['controller' => 'Users', 'action' => $origin]);
    }
    
    public function findPatient()
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) 
        {
            $name = $this->request->query['term'];
            $results = $this->Users->find('all', [
                'conditions' => [['surname LIKE' => $name . '%'], ['role' => 'Paciente']]]);
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
                'conditions' => [['Users.surname LIKE' => $name . '%']]]);
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
                'conditions' => [['Users.surname LIKE' => $name . '%'], ['role' => 'Promotor(a)']]]);
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
}

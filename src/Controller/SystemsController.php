<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Systems Controller
 *
 * @property \App\Model\Table\SystemsTable $Systems
 */
class SystemsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }

    public function isAuthorized($user)
    {
        return parent::isAuthorized($user);
    }        

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $systems = $this->paginate($this->Systems);

        $this->set(compact('systems'));
        $this->set('_serialize', ['systems']);
    }

    /**
     * View method
     *
     * @param string|null $id System id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $system = $this->Systems->get($id, [
            'contain' => []
        ]);

        $this->set('system', $system);
        $this->set('_serialize', ['system']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $system = $this->Systems->newEntity();
        if ($this->request->is('post')) {
            $system = $this->Systems->patchEntity($system, $this->request->data);
            if ($this->Systems->save($system)) {
                $this->Flash->success(__('The system has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The system could not be saved. Please, try again.'));
        }
        $this->set(compact('system'));
        $this->set('_serialize', ['system']);
    }

    /**
     * Edit method
     *
     * @param string|null $id System id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $system = $this->Systems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $system = $this->Systems->patchEntity($system, $this->request->data);
            if ($this->Systems->save($system)) {
                $this->Flash->success(__('The system has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The system could not be saved. Please, try again.'));
        }
        $this->set(compact('system'));
        $this->set('_serialize', ['system']);
    }

    public function systemSwitch($id = 2)
    {
        $system = $this->Systems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $system = $this->Systems->patchEntity($system, $this->request->data);
            if ($this->Systems->save($system)) {
                $this->Flash->success(__('El sistema cambió de estado exitosamente'));

                return $this->redirect(['controller' => 'users', 'action' => 'wait']);
            }
            $this->Flash->error(__('El sistema no pudo cambiar de estado'));
        }
        $this->set(compact('system'));
        $this->set('_serialize', ['system']);
    }

    /**
     * Delete method
     *
     * @param string|null $id System id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $system = $this->Systems->get($id);
        if ($this->Systems->delete($system)) {
            $this->Flash->success(__('The system has been deleted.'));
        } else {
            $this->Flash->error(__('The system could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function checkSystem()
    {
        $this->autoRender = false;
        
        $system = $this->Systems->get(1);
        
        $systemSwitch = $system->system_switch; 
        
        return $systemSwitch;
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Commissions Controller
 *
 * @property \App\Model\Table\CommissionsTable $Commissions
 */
class CommissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Budgets']
        ];
        $commissions = $this->paginate($this->Commissions);

        $this->set(compact('commissions'));
        $this->set('_serialize', ['commissions']);
    }

    /**
     * View method
     *
     * @param string|null $id Commission id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commission = $this->Commissions->get($id, [
            'contain' => ['Users', 'Budgets']
        ]);

        $this->set('commission', $commission);
        $this->set('_serialize', ['commission']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commission = $this->Commissions->newEntity();
        if ($this->request->is('post')) {
            $commission = $this->Commissions->patchEntity($commission, $this->request->data);
            if ($this->Commissions->save($commission)) {
                $this->Flash->success(__('The commission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commission could not be saved. Please, try again.'));
        }
        $users = $this->Commissions->Users->find('list', ['limit' => 200]);
        $budgets = $this->Commissions->Budgets->find('list', ['limit' => 200]);
        $this->set(compact('commission', 'users', 'budgets'));
        $this->set('_serialize', ['commission']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Commission id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commission = $this->Commissions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commission = $this->Commissions->patchEntity($commission, $this->request->data);
            if ($this->Commissions->save($commission)) {
                $this->Flash->success(__('The commission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commission could not be saved. Please, try again.'));
        }
        $users = $this->Commissions->Users->find('list', ['limit' => 200]);
        $budgets = $this->Commissions->Budgets->find('list', ['limit' => 200]);
        $this->set(compact('commission', 'users', 'budgets'));
        $this->set('_serialize', ['commission']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Commission id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commission = $this->Commissions->get($id);
        if ($this->Commissions->delete($commission)) {
            $this->Flash->success(__('The commission has been deleted.'));
        } else {
            $this->Flash->error(__('The commission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

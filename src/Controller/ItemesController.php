<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\I18n\Time;

/**
 * Itemes Controller
 *
 * @property \App\Model\Table\ItemesTable $Itemes
 */
class ItemesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Budgets']
        ];
        $itemes = $this->paginate($this->Itemes);

        $this->set(compact('itemes'));
        $this->set('_serialize', ['itemes']);
    }

    /**
     * View method
     *
     * @param string|null $id Iteme id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $iteme = $this->Itemes->get($id, [
            'contain' => ['Budgets']
        ]);

        $this->set('iteme', $iteme);
        $this->set('_serialize', ['iteme']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idBudget = null, $itemesBudget = null)
    {
        $this->autoRender = false;

        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = time::now();

        $iteme = $this->Itemes->newEntity();

        $iteme->budget_id = $idBudget;
        $iteme->itemes = $itemesBudget;
        $iteme->registration_status = 'ACTIVO';
        $iteme->reason_status = 'NUEVOS ITEMES';
        $iteme->date_status = $currentDate;
        $iteme->responsible_user = 'clnacional2017';

        if ($this->Itemes->save($iteme)) 
        {
            $result = 0;
        }
        else
        {
            $result = 1;
            
        }
        return $result;
    }

    /**
     * Edit method
     *
     * @param string|null $id Iteme id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $iteme = $this->Itemes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $iteme = $this->Itemes->patchEntity($iteme, $this->request->data);
            if ($this->Itemes->save($iteme)) {
                $this->Flash->success(__('The iteme has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The iteme could not be saved. Please, try again.'));
        }
        $budgets = $this->Itemes->Budgets->find('list', ['limit' => 200]);
        $this->set(compact('iteme', 'budgets'));
        $this->set('_serialize', ['iteme']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Iteme id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $iteme = $this->Itemes->get($id);
        if ($this->Itemes->delete($iteme)) {
            $this->Flash->success(__('The iteme has been deleted.'));
        } else {
            $this->Flash->error(__('The iteme could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

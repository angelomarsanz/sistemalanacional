<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Patienthistories Controller
 *
 * @property \App\Model\Table\PatienthistoriesTable $Patienthistories
 */
class PatienthistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $patienthistories = $this->paginate($this->Patienthistories);

        $this->set(compact('patienthistories'));
        $this->set('_serialize', ['patienthistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Patienthistory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $patienthistory = $this->Patienthistories->get($id, [
            'contain' => []
        ]);

        $this->set('patienthistory', $patienthistory);
        $this->set('_serialize', ['patienthistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $patienthistory = $this->Patienthistories->newEntity();
        if ($this->request->is('post')) {
            $patienthistory = $this->Patienthistories->patchEntity($patienthistory, $this->request->data);
            if ($this->Patienthistories->save($patienthistory)) {
                $this->Flash->success(__('The patienthistory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patienthistory could not be saved. Please, try again.'));
        }
        $this->set(compact('patienthistory'));
        $this->set('_serialize', ['patienthistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Patienthistory id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $patienthistory = $this->Patienthistories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patienthistory = $this->Patienthistories->patchEntity($patienthistory, $this->request->data);
            if ($this->Patienthistories->save($patienthistory)) {
                $this->Flash->success(__('The patienthistory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patienthistory could not be saved. Please, try again.'));
        }
        $this->set(compact('patienthistory'));
        $this->set('_serialize', ['patienthistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Patienthistory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patienthistory = $this->Patienthistories->get($id);
        if ($this->Patienthistories->delete($patienthistory)) {
            $this->Flash->success(__('The patienthistory has been deleted.'));
        } else {
            $this->Flash->error(__('The patienthistory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

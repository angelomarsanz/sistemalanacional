<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\BinnaclesController;

/**
 * Parameters Controller
 *
 * @property \App\Model\Table\ParametersTable $Parameters
 */
class ParametersController extends AppController
{
    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Administrador(a) de la clínica' )
            {
                if(in_array($this->request->action, ['edit']))
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
        $parameters = $this->paginate($this->Parameters);

        $this->set(compact('parameters'));
        $this->set('_serialize', ['parameters']);
    }

    /**
     * View method
     *
     * @param string|null $id Parameter id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parameter = $this->Parameters->get($id, [
            'contain' => []
        ]);

        $this->set('parameter', $parameter);
        $this->set('_serialize', ['parameter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parameter = $this->Parameters->newEntity();
        if ($this->request->is('post')) {
            $parameter = $this->Parameters->patchEntity($parameter, $this->request->data);
            if ($this->Parameters->save($parameter)) {
                $this->Flash->success(__('The parameter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parameter could not be saved. Please, try again.'));
        }
        $this->set(compact('parameter'));
        $this->set('_serialize', ['parameter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parameter id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $controller = null, $action = null)
    {
		$binnacles = new BinnaclesController;
		
        $parameter = $this->Parameters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parameter = $this->Parameters->patchEntity($parameter, $this->request->data);
			
			$dollarPromoterPercentage = $parameter->dollar_promoter_percentage;
			$parameter->dollar_promoter_percentage = $dollarPromoterPercentage;

			$dollarFatherPercentage = $parameter->dollar_father_percentage;
			$parameter->dollar_father_percentage = $dollarFatherPercentage;

			$dollarGrandfatherPercentage = $parameter->dollar_Grandfather_percentage;
			$parameter->dollar_Grandfather_percentage = $dollarGrandfatherPercentage;

			$bolivarPromoterPercentage = $parameter->bolivar_promoter_percentage;
			$parameter->bolivar_promoter_percentage = $bolivarPromoterPercentage;

			$bolivarFatherPercentage = $parameter->bolivar_father_percentage;
			$parameter->bolivar_father_percentage = $bolivarFatherPercentage;

			$bolivarGrandfatherPercentage = $parameter->bolivar_Grandfather_percentage;
			$parameter->bolivar_Grandfather_percentage = $bolivarGrandfatherPercentage;			
						
            if ($this->Parameters->save($parameter)) 
			{
                $this->Flash->success(__('Los porcentajes de las comisiones se actualizaron exitosamente'));		
            }
			else
			{
				if($parameter->errors())
				{
					$error_msg = $this->arrayErrors($parameter->errors());
				}
				else
				{
					$error_msg = ['Error desconocido'];
				}
				$this->Flash->error(__("No se pudieron actualizar los porcentajes debido a: " . implode(" - ", $error_msg)));

				foreach($error_msg as $noveltys)
				{
					$binnacles->add('controller', 'Parameters', 'edit', $noveltys . 'id ' . $parameter->id);
				}						
			}
			if (isset($controller) && isset($action))
			{
				return $this->redirect(['controller' => $controller, 'action' => $action]);
			}
			else	
			{
				return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
			}
        }
        $this->set(compact('parameter', 'controller', 'action'));
        $this->set('_serialize', ['parameter', 'controller', 'action']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parameter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parameter = $this->Parameters->get($id);
        if ($this->Parameters->delete($parameter)) {
            $this->Flash->success(__('The parameter has been deleted.'));
        } else {
            $this->Flash->error(__('The parameter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
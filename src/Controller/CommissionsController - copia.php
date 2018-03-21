<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\EmployeesController;

use App\Controller\BinnaclesController;

/**
 * Commissions Controller
 *
 * @property \App\Model\Table\CommissionsTable $Commissions
 */
class CommissionsController extends AppController
{
    public function isAuthorized($user)
    {
        if(isset($user['role']))
        {
            if ($user['role'] === 'Auditor(a) externo' || $user['role'] === 'Auditor(a) interno' || $user['role'] === 'Administrador(a) de la clínica')
            {
                if(in_array($this->request->action, ['add', 'addCommission']))
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
    public function add($idPromoter = null, $idBudget = null, $amount = null, $coin = null)
    {
		$this->autoRender = false;
			
		$binnacles = new BinnaclesController;
		
		$employee = new EmployeesController;
		
		$swError = 0;
		
		$novelty = '';
	
		$employeePromoter = $this->Commissions->Users->get($idPromoter, [
            'contain' => ['Employees']
            ]);
		
		if ($employeePromoter->employees)
		{			
			if ($employeePromoter->deleted_record == null)
			{			
				if ($employeePromoter->role == 'Coordinador(a)' || $employeePromoter->role == 'Promotor(a)' || $employeePromoter->role == 'Promotor(a) independiente')
				{			
					$idFather = $employeePromoter->parent_user;
					
					$arrayResult = $this->addCommission($employeePromoter, 'PROMOTOR', $idBudget, $amount, $coin);
					
					if ($arrayResult['indicator'] == 0)
					{
						$employeeFather = $this->Commissions->Users->get($idFather, [
							'contain' => ['Employees']]);
				
						if ($employeeFather->employees)
						{
							if ($employeeFather->deleted_record == null)
							{
								if ($employeeFather->role == 'Promotor(a)' || $employeeFather->role == 'Promotor(a) independiente')
								{						
									$idGrandfather = $employeeFather->parent_user;
									
									$arrayResult = $this->addCommission($employeeFather, 'FATHER', $idBudget, $amount, $coin);
									
									if ($arrayResult['indicator'] == 0)
									{
										$employeeGrandfather = $this->Commissions->Users->get($idGrandfather, [
											'contain' => ['Employees']]);
								
										if ($employeeGrandfather->employees)
										{										
											if ($employeeGrandfather->deleted_record == null)
											{
												if ($employeeGrandfather->role == 'Promotor(a)' || $employeeGrandfather->role == 'Promotor(a) independiente')
												{																
													$arrayResult = $this->addCommission($employeeGrandfather, 'GRANDFATHER', $idBudget, $amount, $coin);
													
													if ($arrayResult['indicator'] != 0)
													{
														$swError = 1;
						
														$novelty = 'No se pudo registrar la comisión del promotor-abuelo';
													}
												}
											}
										}
										else
										{
											$swError = 1;
											
											$novelty = 'No se pudo registrar la comisión del promotor-abuelo';
										}
									}
									else
									{
										$swError = 1;
										
										$novelty = 'No se pudo registrar la comisión del promotor-padre';
									}
								}
							}
						}
						else
						{
							$swError = 1;
							
							$novelty = 'No se encontraron los datos básicos del promotor-padre';
						}
					}
					else
					{
						$swError = 1;
				
						$novelty = 'No se pudo registrar la comisión del promotor';
					}
				}
			}
		}
		else
		{
			$swError = 1;
			
			$novelty = 'No se encontraron los datos básicos del promotor';
		}
		if ($swError != 0)
		{
			$this->Flash->error(__($novelty));
			
			$binnacles->add('controller', 'Commissions', 'add', $novelty);
		}
    }
	
	public function addCommission($employeePromoter = null, $typeBeneficiary = null, $idBudget = null, $amount = null, $coin)
	{
		$this->autoRender = false;
		
		$arrayResult = [];
	
        $commission = $this->Commissions->newEntity();
		
		$commission->user_id = $employeePromoter->id;
		
		$commission->budget_id = $idBudget;

		$commission->type_beneficiary = $typeBeneficiary;
		
		if ($typeBeneficiary == 'PROMOTOR')
		{
			$commission->amount = $amount * 0.03;
		}
		elseif ($typeBeneficiary == 'FATHER')
		{
			$commission->amount = $amount * 0.015;
		}
		else
		{
			$commission->amount = $amount * 0.005;
		}
		
		$commission->coin = $coin;
			
		$commission->payment_method = $employeePromoter->employees[0]['payment_method'];
	
		$commission->account = $employeePromoter->employees[0]['account_bank'];

		$commission->account_type = $employeePromoter->employees[0]['account_type'];
		
		$commission->bank = $employeePromoter->employees[0]['bank'];
		
		$commission->bank_address = $employeePromoter->employees[0]['bank_address'];
		
		$commission->swif_bank = $employeePromoter->employees[0]['swif_bank'];
		
		$commission->aba_bank = $employeePromoter->employees[0]['aba_bank'];
		
		$commission->responsible_user = $this->Auth->user('username');
		
		if ($this->Commissions->save($commission)) 
		{
			$arrayResult['indicator'] = 0;
		}
		else
		{
			$arrayResult['indicator'] = 1;
		}
			
		return $arrayResult;
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
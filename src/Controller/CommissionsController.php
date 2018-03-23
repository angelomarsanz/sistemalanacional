<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Controller\EmployeesController;

use App\Controller\BinnaclesController;

use Cake\ORM\TableRegistry;

use Cake\I18n\Time;

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
	
	public function testFunction()
	{

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
    public function add($idPromoter = null, $idBudget = null, $amount = null, $coin = null, $swDelete = null)
    {
		$this->autoRender = false;
			
		$binnacles = new BinnaclesController;
		
		$employee = new EmployeesController;
		
		$swError = 0;
		
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
					
					$arrayResult = $this->addCommission($employeePromoter, 'PROMOTOR', $idBudget, $amount, $coin, $swDelete);
					
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
									
									$arrayResult = $this->addCommission($employeeFather, 'PROMOTOR-PADRE', $idBudget, $amount, $coin, $swDelete);
									
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
													$arrayResult = $this->addCommission($employeeGrandfather, 'PROMOTOR-ABUELO', $idBudget, $amount, $coin, $swDelete);
													
													if ($arrayResult['indicator'] != 0)
													{
														$swError = 1;
						
														$novelty = $arraResult['arrayError'];
													}
												}
											}
										}
										else
										{
											$swError = 1;
											
											$novelty = ['No se encontraron los datos básicos del promotor-abuelo'];
										}
									}
									else
									{
										$swError = 1;
										
										$novelty = $arraResult['arrayError'];
									}
								}
							}
						}
						else
						{
							$swError = 1;
							
							$novelty = ['No se encontraron los datos básicos del promotor-padre'];
						}
					}
					else
					{
						$swError = 1;
				
						$novelty = $arrayResult['arrayError'];
					}
				}
			}
		}
		else
		{
			$swError = 1;
			
			$novelty = ['No se encontraron los datos básicos del promotor'];
		}
		
		$arrayResult = [];
	
		if ($swError == 0)
		{	
			$arrayResult['indicator'] = 0;
		}
		else
		{
			$arrayResult['indicator'] = 1;
			$arrayResult['arrayError'] = $novelty;
		}
		return $arrayResult;
    }
	
	public function addCommission($employeePromoter = null, $typeBeneficiary = null, $idBudget = null, $amount = null, $coin, $swDelete = null)
	{
		$this->autoRender = false;
		
		$arrayResult = [];
		
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');

        $currentDate = time::now();
		
		$lastRecord = $this->Commissions->find('all', ['conditions' => [['user_id' => $employeePromoter->id], ['budget_id' => $idBudget]], 
			'order' => ['Commissions.created' => 'DESC'] ]);

		$row = $lastRecord->first();
		
		if ($row)
		{
			$commission = $this->Commissions->get($row->id);		
		}
		else
		{
			if ($swDelete == 0)
			{
				$commission = $this->Commissions->newEntity();
			}
			else
			{
				$arrayResult['indicator'] = 0;
				return $arrayResult;
			}
		}

		if ($swDelete == 1)
		{
			$commission->registration_status = 'ELIMINADO';
		}
		else
		{
			$commission->user_id = $employeePromoter->id;
			
			$commission->budget_id = $idBudget;

			$commission->type_beneficiary = $typeBeneficiary;
			
			if ($typeBeneficiary == 'PROMOTOR')
			{
				$commission->amount = $amount * 0.03;
			}
			elseif ($typeBeneficiary == 'PROMOTOR-PADRE')
			{
				$commission->amount = $amount * 0.015;
			}
			else
			{
				$commission->amount = $amount * 0.005;
			}
			
			$commission->coin = $coin;
						
			$commission->status_commission = 'PENDIENTE DE PAGO';
			
			$commission->registration_status = 'ACTIVO';
		}
		
		$commission->date_status = $currentDate;
		
		$commission->responsible_user = $this->Auth->user('username');
		
		if ($this->Commissions->save($commission)) 
		{
			$arrayResult['indicator'] = 0;
		}
		else
		{
			$arrayResult['indicator'] = 1;
			
			if($commission->errors())
			{
                $error_msg = $this->arrayErrors($commission->errors());
			}
			else
			{
				$error_msg = ['Error desconocido'];
			}
			
			$arrayResult['arrayError'] = $error_msg;

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

		if(empty($error_msg))
		{
			$error_msg[] = 'Error desconocido';
		}

		return $error_msg;
	}

	public function reportCommissions()
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
						
			$commissions = TableRegistry::get('Commissions');

			$arrayResult = $commissions->find('commissions');
			
			if ($arrayResult['indicator'] == 1)
			{
				$this->Flash->error(___('No se encontraron comisiones'));
				$binnacles->add('controller', 'Commissions', 'reportCommissions', 'No se encontraron comisiones');
				
				return $this->redirect(['controller' => 'Users', 'action' => 'wait']);
			}
			else
			{
				$commissions = $arrayResult['searchRequired'];
			}
	
			$swImpresion = 1;
						
			$this->set(compact('swImpresion', 'commissions', 'arrayMark', 'currentDate'));
			$this->set('_serialize', ['swImpresion', 'commissions', 'arrayMark', 'currenDate']); 
		
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
		
		isset($columnsReport['Commissions.type_beneficiary']) ? $arrayMark['Commissions.type_beneficiary'] = 'siExl' : $arrayMark['Commissions.type_beneficiary'] = 'noExl';
				
		isset($columnsReport['Commissions.amount']) ? $arrayMark['Commissions.amount'] = 'siExl' : $arrayMark['Commissions.amount'] = 'noExl';
		
		isset($columnsReport['Commissions.coin']) ? $arrayMark['Commissions.coin'] = 'siExl' : $arrayMark['Commissions.coin'] = 'noExl';
		
		isset($columnsReport['Commissions.payment_method']) ? $arrayMark['Commissions.payment_method'] = 'siExl' : $arrayMark['Commissions.payment_method'] = 'noExl';
		
		isset($columnsReport['Commissions.account']) ? $arrayMark['Commissions.account'] = 'siExl' : $arrayMark['Commissions.account'] = 'noExl';
		
		isset($columnsReport['Commissions.account_type']) ? $arrayMark['Commissions.account_type'] = 'siExl' : $arrayMark['Commissions.account_type'] = 'noExl';
		
		isset($columnsReport['Commissions.bank']) ? $arrayMark['Commissions.bank'] = 'siExl' : $arrayMark['Commissions.bank'] = 'noExl';
		
		isset($columnsReport['Commissions.bank_address']) ? $arrayMark['Commissions.bank_address'] = 'siExl' : $arrayMark['Commissions.bank_address'] = 'noExl';
		
		isset($columnsReport['Commissions.swif_bank']) ? $arrayMark['Commissions.swif_bank'] = 'siExl' : $arrayMark['Commissions.swif_bank'] = 'noExl';
		
		isset($columnsReport['Commissions.aba_bank']) ? $arrayMark['Commissions.aba_bank'] = 'siExl' : $arrayMark['Commissions.aba_bank'] = 'noExl';
		
		isset($columnsReport['Commissions.reference']) ? $arrayMark['Commissions.reference'] = 'siExl' : $arrayMark['Commissions.reference'] = 'noExl';

		isset($columnsReport['Commissions.pay_day']) ? $arrayMark['Commissions.pay_day'] = 'siExl' : $arrayMark['Commissions.pay_day'] = 'noExl';

		isset($columnsReport['Commissions.status_commission']) ? $arrayMark['Commissions.status_commission'] = 'siExl' : $arrayMark['Commissions.status_commission'] = 'noExl';		

		return $arrayMark;
	}	
}
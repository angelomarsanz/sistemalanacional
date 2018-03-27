<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Budgets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Patients
 * @property \Cake\ORM\Association\HasMany $Diarypatients
 * @property \Cake\ORM\Association\HasMany $Patienthistories
 *
 * @method \App\Model\Entity\Budget get($primaryKey, $options = [])
 * @method \App\Model\Entity\Budget newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Budget[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Budget|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Budget patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Budget[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Budget findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BudgetsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('budgets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    
        $this->addBehavior('Proffer.Proffer', [
            'initial_budget' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'initial_budget_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'thumb' => [   // Define the prefix of your thumbnail
                        'w' => 500, // Width
                        'h' => 500, // Height
                        'crop' => true,  // Crop will crop the image as well as resize it
                        'jpeg_quality'  => 100,
                        'png_compression_level' => 9
                    ],
                ],
                'thumbnailMethod' => 'php'  // Options are Imagick, Gd or Gmagick
            ],
            'bill' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'bill_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'thumb' => [   // Define the prefix of your thumbnail
                        'w' => 500, // Width
                        'h' => 500, // Height
                        'crop' => true,  // Crop will crop the image as well as resize it
                        'jpeg_quality'  => 100,
                        'png_compression_level' => 9
                    ],
                ],
                'thumbnailMethod' => 'php'  // Options are Imagick, Gd or Gmagick
            ]
        ]);
        
        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Diarypatients', [
            'foreignKey' => 'budget_id'
        ]);
        $this->hasMany('Itemes', [
            'foreignKey' => 'budget_id'
        ]);
        $this->hasMany('Patienthistories', [
            'foreignKey' => 'budget_id'
        ]);
        $this->hasMany('Commissions', [
            'foreignKey' => 'budget_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->date('application_date')
            ->requirePresence('application date', 'create')
            ->notEmpty('application date');

        $validator
            ->requirePresence('surgery', 'create')
            ->notEmpty('surgery');
            
        $validator
            ->allowEmpty('coin');

        $validator
            ->dateTime('activity_date_finish')
            ->allowEmpty('activity_date_finish');

        $validator
            ->allowEmpty('activity_result');

        $validator
            ->allowEmpty('detailed_result_activity');
            
        $validator
            ->allowEmpty('initial_budget');

        $validator
            ->allowEmpty('initial_budget_dir');

        $validator
            ->date('date_budget')
            ->allowEmpty('date_budget');

        $validator
            ->date('expiration_date')
            ->allowEmpty('expiration_date');
            
        $validator
            ->allowEmpty('consecutive_budget');

        $validator
            ->allowEmpty('number_budget');

        $validator
            ->allowEmpty('amount_budget');
            
        $validator
            ->allowEmpty('bill');

        $validator
            ->allowEmpty('bill_dir');

        $validator
            ->date('date_bill')
            ->allowEmpty('date_bill');
            
        $validator
            ->allowEmpty('number_bill');

        $validator
            ->allowEmpty('amount_bill');
			
        $validator
            ->allowEmpty('coin_bill');
			
        $validator
            ->allowEmpty('extra_column1');
			
        $validator
            ->allowEmpty('extra_column2');
			
        $validator
            ->allowEmpty('extra_column3');
			
        $validator
            ->allowEmpty('extra_column4');
			
        $validator
            ->allowEmpty('extra_column5');
			
        $validator
            ->allowEmpty('extra_column6');
			
        $validator
            ->allowEmpty('extra_column7');
			
        $validator
            ->allowEmpty('extra_column8');
			
        $validator
            ->allowEmpty('extra_column9');
			
        $validator
            ->allowEmpty('extra_column10');			
            
        $validator
            ->allowEmpty('registration_status');	
			
        $validator
            ->allowEmpty('reason_status');	
			
        $validator
            ->allowEmpty('responsible_user');

        $validator
            ->boolean('deleted_record')
            ->allowEmpty('deleted_record');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['patient_id'], 'Patients'));

        return $rules;
    }

    public function findOnly(Query $query, array $options)
    {
        $query->where([['patient_id' => $options['patient_id']], ['surgery' => $options['surgery']]])
            ->order(['created' => 'DESC']);
        
        $row = $query->first();
        
        $arrayResult = [];
        
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
    public function findBudget(Query $query, array $options)
    {
		$arrayResult = [];

		$query->select(
            ['Budgets.id',
			'Budgets.surgery',
			'Budgets.coin',
			'Budgets.number_budget',
			'Budgets.application_date',
			'Budgets.expiration_date',
			'Budgets.amount_budget',
			'Budgets.initial_budget',
			'Budgets.initial_budget_dir',
			'Patients.id',
			'Patients.address',
			'Patients.country',
			'Users.id',
			'Users.first_name',
			'Users.second_name',
			'Users.surname',
			'Users.second_surname',
			'Users.parent_user',
			'Users.cell_phone'])
			->contain(['Patients' => ['Users']])	
			->where(['Budgets.id' => $options['id']])
			->order(['Budgets.created' => 'DESC']);
			
		$row = $query->first();
        
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
}
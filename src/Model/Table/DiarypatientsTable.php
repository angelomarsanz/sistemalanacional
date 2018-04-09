<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diarypatients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Budgets
 *
 * @method \App\Model\Entity\Diarypatient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Diarypatient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Diarypatient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Diarypatient|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diarypatient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Diarypatient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Diarypatient findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DiarypatientsTable extends Table
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

        $this->table('diarypatients');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Budgets', [
            'foreignKey' => 'budget_id',
            'joinType' => 'INNER'
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
            ->date('activity_date')
            ->notEmpty('activity_date');

        $validator
            ->notEmpty('short_description_activity');

        $validator
            ->notEmpty('detailed_activity_description');
            
        $validator
            ->allowEmpty('activity_comments');            

        $validator
            ->date('activity_date_next')
            ->notEmpty('activity_date_finish');

        $validator
            ->notEmpty('activity_next');

        $validator
            ->notEmpty('detailed_next_activity');

        $validator
            ->allowEmpty('status');
			
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
        $rules->add($rules->existsIn(['budget_id'], 'Budgets'));

        return $rules;
    }
    public function findDiary(Query $query, array $options)
    {
        $arrayResult = [];
	
        $query->select(
            ['Diarypatients.id',
            'Diarypatients.activity_date', 
            'Diarypatients.short_description_activity', 
            'Budgets.id', 
			'Budgets.patient_id',
            'Budgets.surgery', 
            'Budgets.initial_budget', 
            'Budgets.initial_budget_dir', 
			'Budgets.activity_result',
			'Budgets.deleted_record',
            'Patients.landline',
            'Users.id',
            'Users.parent_user', 
            'Users.first_name', 
            'Users.second_name', 
            'Users.surname', 
            'Users.second_surname',
            'Users.cell_phone',
            'Users.email'])
            ->contain(['Budgets' => ['Patients' => ['Users']]])
            ->order(['Diarypatients.activity_date' => 'DESC']);
    
        if ($query)
        {
            $arrayResult['indicator'] = 0;
            $arrayResult['searchRequired'] = $query;
        }
        else
        {
            $arrayResult['indicator'] = 1;
        }
        return $arrayResult;
    }
    public function findReport(Query $query, array $options)
    {
        $arrayResult = [];
	
        $query->contain(['Budgets' => ['Patients' => ['Users']]])
            ->order(['Users.surname' => 'ASC', 'Users.second_surname' => 'ASC', 'Users.first_name' => 'ASC', 'Users.second_name' => 'ASC']);
    
        if ($query)
        {
            $arrayResult['indicator'] = 0;
            $arrayResult['searchRequired'] = $query;
        }
        else
        {
            $arrayResult['indicator'] = 1;
        }
        return $arrayResult;
    }	
}
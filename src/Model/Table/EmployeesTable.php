<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Positions
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
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

        $this->table('employees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id',
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
            ->allowEmpty('rif');

        $validator
            ->allowEmpty('place_of_birth');

        $validator
            ->allowEmpty('country_of_birth');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmpty('birthdate');

        $validator
            ->requirePresence('landline', 'create')
            ->notEmpty('landline');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->allowEmpty('degree_instruction');

        $validator
            ->date('date_of_admission')
            ->requirePresence('date_of_admission', 'create')
            ->notEmpty('date_of_admission');

        $validator
            ->date('retirement_date')
            ->allowEmpty('retirement_date');

        $validator
            ->allowEmpty('reason_withdrawal');

        $validator
            ->requirePresence('classification', 'create')
            ->notEmpty('classification');

        $validator
            ->allowEmpty('working_agreement');

        $validator
            ->numeric('percentage_imposed')
            ->allowEmpty('percentage_imposed');

        $validator
            ->allowEmpty('payment_method');
			
        $validator
            ->allowEmpty('bank');
            
        $validator
            ->allowEmpty('account_type');
            
        $validator
            ->allowEmpty('account_bank');
			
        $validator
            ->allowEmpty('bank_address');
			
        $validator
            ->allowEmpty('swift_bank');
			
        $validator
            ->allowEmpty('aba_bank');
            
        $validator
            ->boolean('record_deleted')
            ->allowEmpty('record_deleted');

        $validator
            ->allowEmpty('responsible_user');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['position_id'], 'Positions'));

        return $rules;
    }
    public function findOnly(Query $query, array $options)
    {
        $query->where(['user_id' => $options['user_id']])
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
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Multilevels Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Multilevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Multilevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Multilevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Multilevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Multilevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Multilevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Multilevel findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MultilevelsTable extends Table
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

        $this->table('multilevels');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmpty('birthdate');

        $validator
            ->requirePresence('profession', 'create')
            ->notEmpty('profession');

        $validator
            ->allowEmpty('landline');

        $validator
            ->allowEmpty('country');

        $validator
            ->allowEmpty('province_state');

        $validator
            ->allowEmpty('city');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->date('deactivation_date')
            ->allowEmpty('deactivation_date');

        $validator
            ->allowEmpty('account_number');

        $validator
            ->allowEmpty('bank');

        $validator
            ->allowEmpty('bank_address');

        $validator
            ->allowEmpty('swift_bank');

        $validator
            ->allowEmpty('aba_bank');

        $validator
            ->allowEmpty('responsible_user');

        $validator
            ->boolean('deleted_record')
            ->allowEmpty('delete_record');

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
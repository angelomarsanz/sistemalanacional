<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commissions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Budgets
 *
 * @method \App\Model\Entity\Commission get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Commission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commission findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommissionsTable extends Table
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

        $this->table('commissions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
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
            ->allowEmpty('type_beneficiary');

        $validator
            ->numeric('amount')
            ->allowEmpty('amount');

        $validator
            ->allowEmpty('coin');

        $validator
            ->allowEmpty('payment_method');

        $validator
            ->allowEmpty('bank');

        $validator
            ->allowEmpty('account');

        $validator
            ->allowEmpty('reference');

        $validator
            ->dateTime('pay_day')
            ->allowEmpty('pay_day');

        $validator
            ->allowEmpty('voucher');

        $validator
            ->allowEmpty('voucher_dir');

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
            ->dateTime('date_status')
            ->allowEmpty('date_status');

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
		
		$rules->add($rules->isUnique(
			['user_id', 'budget_id'],
			)); 
									
		return $rules;
    }
}
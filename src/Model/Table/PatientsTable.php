<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Supervisors
 * @property \Cake\ORM\Association\BelongsTo $Promoters
 * @property \Cake\ORM\Association\BelongsTo $Vendors
 * @property \Cake\ORM\Association\HasMany $Diarypatients
 * @property \Cake\ORM\Association\HasMany $Historypatients
 * @property \Cake\ORM\Association\HasMany $Servicescontracts
 *
 * @method \App\Model\Entity\Patient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Patient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patient|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patient findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PatientsTable extends Table
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

        $this->table('patients');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Budgets', [
            'foreignKey' => 'patient_id'
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
            ->allowEmpty('profession');

        $validator
            ->allowEmpty('work_phone');

        $validator
            ->allowEmpty('workplace');

        $validator
            ->allowEmpty('work_address');

        $validator
            ->allowEmpty('landline');

        $validator
            ->allowEmpty('country');

        $validator
            ->allowEmpty('province_state');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('account_bank');

        $validator
            ->allowEmpty('bank');

        $validator
            ->allowEmpty('bank_address');

        $validator
            ->allowEmpty('swift_bank');

        $validator
            ->allowEmpty('aba_bank');

        $validator
            ->allowEmpty('first_name_emergency');

        $validator
            ->allowEmpty('second_name_emergency');

        $validator
            ->allowEmpty('surname_emergency');

        $validator
            ->allowEmpty('second_surname_emergency');

        $validator
            ->allowEmpty('type_of_identification_emergency');

        $validator
            ->allowEmpty('identidy_card_emergency');

        $validator
            ->allowEmpty('address_emergency');

        $validator
            ->allowEmpty('email_emergency');
            
        $validator
            ->allowEmpty('landline_emergency');

        $validator
            ->allowEmpty('cell_phone_emergency');

        $validator
            ->allowEmpty('first_name_companion');

        $validator
            ->allowEmpty('second_name_companion');

        $validator
            ->allowEmpty('surname_companion');

        $validator
            ->allowEmpty('second_surname_companion');

        $validator
            ->allowEmpty('type_of_identification_companion');

        $validator
            ->allowEmpty('identidy_card_companion');

        $validator
            ->allowEmpty('address_companion');

        $validator
            ->allowEmpty('email_companion');

        $validator
            ->allowEmpty('landline_companion');

        $validator
            ->allowEmpty('cell_phone_companion');

        $validator
            ->allowEmpty('sponsor');

        $validator
            ->allowEmpty('sponsor_type');

        $validator
            ->allowEmpty('sponsor_identification');

        $validator
            ->allowEmpty('address_sponsor');

        $validator
            ->allowEmpty('email_sponsor');

        $validator
            ->allowEmpty('landline_sponsor');

        $validator
            ->allowEmpty('cell_phone_sponsor');

        $validator
            ->allowEmpty('responsible_user');

        $validator
            ->boolean('record_delete')
            ->allowEmpty('record_delete'); 

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}

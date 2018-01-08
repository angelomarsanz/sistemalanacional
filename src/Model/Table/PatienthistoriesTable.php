<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patienthistories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Budgets
 *
 * @method \App\Model\Entity\Patienthistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patienthistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Patienthistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patienthistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patienthistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patienthistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patienthistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PatienthistoriesTable extends Table
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

        $this->table('patienthistories');
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
            ->dateTime('activity_date')
            ->allowEmpty('activity_date');

        $validator
            ->allowEmpty('short_description_activity');

        $validator
            ->allowEmpty('detailed_activity_description');

        $validator
            ->dateTime('activity_date_finish')
            ->allowEmpty('activity_date_finish');

        $validator
            ->allowEmpty('activity_result');

        $validator
            ->allowEmpty('detailed_result_activity');

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
}

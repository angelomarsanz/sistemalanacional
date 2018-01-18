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
            ->dateTime('activity_date')
            ->notEmpty('activity_date');

        $validator
            ->notEmpty('short_description_activity');

        $validator
            ->notEmpty('detailed_activity_description');
            
        $validator
            ->allowEmpty('activity_comments');            

        $validator
            ->dateTime('activity_date_next')
            ->notEmpty('activity_date_finish');

        $validator
            ->notEmpty('activity_next');

        $validator
            ->notEmpty('detailed_next_activity');

        $validator
            ->allowEmpty('status');
            
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

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Itemes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Budgets
 *
 * @method \App\Model\Entity\Iteme get($primaryKey, $options = [])
 * @method \App\Model\Entity\Iteme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Iteme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Iteme|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Iteme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Iteme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Iteme findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemesTable extends Table
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

        $this->table('itemes');
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
            ->allowEmpty('itemes');

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
        $rules->add($rules->existsIn(['budget_id'], 'Budgets'));

        return $rules;
    }
}

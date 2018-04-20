<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parameters Model
 *
 * @method \App\Model\Entity\Parameter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parameter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Parameter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parameter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parameter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parameter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parameter findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ParametersTable extends Table
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

        $this->table('parameters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmpty('ambient');

        $validator
            ->decimal('dollar_promoter_percentage')
            ->allowEmpty('dollar_promoter_percentage');

        $validator
            ->decimal('dollar_father_percentage')
            ->allowEmpty('dollar_father_percentage');

        $validator
            ->decimal('dollar_grandfather_percentage')
            ->allowEmpty('dollar_grandfather_percentage');

        $validator
            ->decimal('bolivar_promoter_percentage')
            ->allowEmpty('bolivar_promoter_percentage');

        $validator
            ->decimal('bolivar_father_percentage')
            ->allowEmpty('bolivar_father_percentage');

        $validator
            ->decimal('bolivar_grandfather_percentage')
            ->allowEmpty('bolivar_grandfather_percentage');

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
            ->allowEmpty('extra_column11');

        $validator
            ->allowEmpty('extra_column12');

        $validator
            ->allowEmpty('extra_column13');

        $validator
            ->allowEmpty('extra_column14');

        $validator
            ->allowEmpty('extra_column15');

        $validator
            ->allowEmpty('extra_column16');

        $validator
            ->allowEmpty('extra_column17');

        $validator
            ->allowEmpty('extra_column18');

        $validator
            ->allowEmpty('extra_column19');

        $validator
            ->allowEmpty('extra_column20');

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
}

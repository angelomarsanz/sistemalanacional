<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Systems Model
 *
 * @method \App\Model\Entity\System get($primaryKey, $options = [])
 * @method \App\Model\Entity\System newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\System[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\System|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\System patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\System[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\System findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SystemsTable extends Table
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

        $this->table('systems');
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
            ->allowEmpty('clinical_name');

        $validator
            ->allowEmpty('identification');

        $validator
            ->allowEmpty('fiscal_address');

        $validator
            ->allowEmpty('tax_phone');

        $validator
            ->allowEmpty('logo');
			
        $validator
            ->allowEmpty('logo_dir');

        $validator
            ->boolean('system_switch')
            ->allowEmpty('system_switch');
			
        $validator
            ->allowEmpty('ambient');
			
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
						
        return $validator;
    }
}

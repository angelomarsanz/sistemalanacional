<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Services Model
 *
 * @property \Cake\ORM\Association\HasMany $Hiredservices
 *
 * @method \App\Model\Entity\Service get($primaryKey, $options = [])
 * @method \App\Model\Entity\Service newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Service[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Service|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Service patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Service[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Service findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ServicesTable extends Table
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

        $this->table('services');
        $this->displayField('service_description');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Hiredservices', [
            'foreignKey' => 'service_id'
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
            ->allowEmpty('service_code');

        $validator
            ->requirePresence('service_description', 'create')
            ->notEmpty('service_description');
            
        $validator
            ->allowEmpty('full_service_description');

        $validator
            ->numeric('cost_bolivars')
            ->allowEmpty('cost_bolivars');

        $validator
            ->numeric('national_dollar_cost')
            ->allowEmpty('national_dollar_cost');
			
        $validator
            ->numeric('national_dollar_cost')
            ->allowEmpty('national_dollar_cost');
			
        $validator
            ->allowEmpty('registration_status');

        $validator
            ->allowEmpty('reason_status');

        $validator
            ->dateTime('date_status')
            ->allowEmpty('date_status');

        $validator
            ->allowEmpty('responsible_user');

        $validator
            ->notEmpty('extra_column1');
			
        $validator
            ->notEmpty('extra_column2');

        $validator
            ->notEmpty('extra_column3');

        $validator
            ->notEmpty('extra_column4');
			
        $validator
            ->notEmpty('extra_column5');			
			
        $validator
            ->notEmpty('extra_column6');

        $validator
            ->notEmpty('extra_column7');

        $validator
            ->notEmpty('extra_column8');			

        $validator
            ->notEmpty('extra_column9');						
			
        $validator
            ->notEmpty('extra_column10');			
			
        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(
            ['service_code'],
            'Este código ya está asignado a otro servicio'
        ));
        
        $rules->add($rules->isUnique(
            ['service_description'],
            'Este servicio ya está registrado'
        ));

        return $rules;
    }

    public function findServices(Query $query, array $options)
    {
        $query->order(['service_description' => 'ASC']);
        
        $arrayResult = [];
        
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

    public function findOnly(Query $query, array $options)
    {
        $arrayResult = [];

        $query->order(['created' => 'DESC']);
        
        $row = $query->first();
        
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

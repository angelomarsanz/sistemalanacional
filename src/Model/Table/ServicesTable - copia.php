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
            ->requirePresence('service_code', 'create')
            ->notEmpty('service_code');

        $validator
            ->requirePresence('service_description', 'create')
            ->notEmpty('service_description');
            
        $validator
            ->allowEmpty('full_service_description');

        $validator
            ->numeric('cost_bolivars')
            ->allowEmpty('cost_bolivars');

        $validator
            ->numeric('cost_dollars')
            ->allowEmpty('cost_dollars');

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

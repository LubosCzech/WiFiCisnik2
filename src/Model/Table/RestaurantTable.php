<?php
namespace App\Model\Table;

use App\Model\Entity\Restaurant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Restaurant Model
 *
 */
class RestaurantTable extends Table
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

        $this->table('restaurant');
        $this->displayField('ID');
        $this->primaryKey('ID');

        $this->hasMany('Checkout');
        $this->hasOne('Configuration');
        $this->hasMany('News',[
            'foreignKey' => 'Restaurant_ID'
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
            ->add('ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('ID', 'create');

        $validator
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->requirePresence('Code', 'create')
            ->notEmpty('Code');

        $validator
            ->requirePresence('LogoUrl', 'create')
            ->notEmpty('LogoUrl');

        $validator
            ->requirePresence('WebUrl', 'create')
            ->notEmpty('WebUrl');

        return $validator;
    }
}

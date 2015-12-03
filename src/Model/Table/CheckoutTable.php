<?php
namespace App\Model\Table;

use App\Model\Entity\Checkout;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Checkout Model
 *
 */
class CheckoutTable extends Table
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

        $this->table('checkout');
        $this->displayField('ID');
        $this->primaryKey('ID');

        $this->belongsTo('Restaurant');
        $this->hasMany('Place');
        $this->hasMany('User');

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
            ->add('Restaurant_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Restaurant_ID', 'create')
            ->notEmpty('Restaurant_ID');

        return $validator;
    }
}

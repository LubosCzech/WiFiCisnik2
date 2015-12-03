<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * User Model
 *
 */
class UserTable extends Table
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

        $this->table('user');
        $this->displayField('ID');
        $this->primaryKey('ID');

        $this->belongsTo('Checkout');

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
            ->requirePresence('FullName', 'create')
            ->notEmpty('FullName');

        $validator
            ->requirePresence('Login', 'create')
            ->notEmpty('Login');

        $validator
            ->requirePresence('Password', 'create')
            ->notEmpty('Password');

        $validator
            ->add('Role', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Role', 'create')
            ->notEmpty('Role');

        $validator
            ->add('Checkout_ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Checkout_ID');

        return $validator;
    }
}

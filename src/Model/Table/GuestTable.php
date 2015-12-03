<?php
namespace App\Model\Table;

use App\Model\Entity\Guest;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Guest Model
 *
 */
class GuestTable extends Table
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

        $this->table('guest');
        $this->displayField('ID');
        $this->primaryKey('ID');

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
            ->allowEmpty('Name');

        $validator
            ->allowEmpty('Code');

        $validator
            ->add('Active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('Active', 'create')
            ->notEmpty('Active');

        $validator
            ->add('Place_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Place_ID', 'create')
            ->notEmpty('Place_ID');

        $validator
            ->requirePresence('LastActive', 'create')
            ->notEmpty('LastActive');

        return $validator;
    }
}

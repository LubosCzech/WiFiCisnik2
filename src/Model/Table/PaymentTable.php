<?php
namespace App\Model\Table;

use App\Model\Entity\Payment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payment Model
 *
 */
class PaymentTable extends Table
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

        $this->table('payment');
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
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->requirePresence('Code', 'create')
            ->notEmpty('Code');

        $validator
            ->add('Type', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Type', 'create')
            ->notEmpty('Type');

        $validator
            ->add('Gratuity', 'valid', ['rule' => 'boolean'])
            ->requirePresence('Gratuity', 'create')
            ->notEmpty('Gratuity');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use App\Model\Entity\ProductOption;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductOption Model
 *
 */
class ProductOptionTable extends Table
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

        $this->table('product_option');
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
            ->add('Product_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Product_ID', 'create')
            ->notEmpty('Product_ID');

        $validator
            ->add('Option_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Option_ID', 'create')
            ->notEmpty('Option_ID');

        return $validator;
    }
}

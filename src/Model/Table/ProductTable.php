<?php
namespace App\Model\Table;

use App\Model\Entity\Product;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Product Model
 *
 */
class ProductTable extends Table
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

        $this->table('product');
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
            ->requirePresence('Code', 'create')
            ->notEmpty('Code');

        $validator
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->add('Price', 'valid', ['rule' => 'decimal'])
            ->requirePresence('Price', 'create')
            ->notEmpty('Price');

        $validator
            ->allowEmpty('Description');

        $validator
            ->allowEmpty('ImageUrl');

        $validator
            ->add('IsOption', 'valid', ['rule' => 'boolean'])
            ->requirePresence('IsOption', 'create')
            ->notEmpty('IsOption');

        $validator
            ->add('Restaurant_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Restaurant_ID', 'create')
            ->notEmpty('Restaurant_ID');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use App\Model\Entity\OrderProduct;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderProduct Model
 *
 */
class OrderProductTable extends Table
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

        $this->table('order_product');
        $this->displayField('ID');
        $this->primaryKey('ID');

        $this->belongsTo('OrderGuest');
        $this->belongsTo('Product');
        //$this->hasOne('Product');
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
            ->add('Order_Guest_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Order_Guest_ID', 'create')
            ->notEmpty('Order_Guest_ID');

        $validator
            ->add('Product_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Product_ID', 'create')
            ->notEmpty('Product_ID');

        $validator
            ->add('Quantity', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Quantity', 'create')
            ->notEmpty('Quantity');

        $validator
            ->add('Price', 'valid', ['rule' => 'decimal'])
            ->requirePresence('Price', 'create')
            ->notEmpty('Price');

        $validator
            ->add('PriceTotal', 'valid', ['rule' => 'decimal'])
            ->requirePresence('PriceTotal', 'create')
            ->notEmpty('PriceTotal');

        return $validator;
    }
}

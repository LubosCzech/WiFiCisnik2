<?php
namespace App\Model\Table;

use App\Model\Entity\OrderGuest;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderGuest Model
 *
 */
class OrderGuestTable extends Table
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

        $this->table('order_guest');
        $this->displayField('ID');
        $this->primaryKey('ID');

        //$this->hasMany('OrderProduct',[
        //    'foreignKey' => 'Order_Guest_ID'
       // ]);
        $this->belongsTo('OrderMain');

        $this->belongsToMany('Product', [
            'through' => 'OrderProduct',
            'foreignKey' => 'Order_Guest_ID',
        ]);

        $this->belongsTo('Payment');

        $this->hasOne('Note',[
            'foreignKey' => 'OrderGuest_ID'
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
            ->add('PaymentState', 'valid', ['rule' => 'numeric'])
            ->requirePresence('PaymentState', 'create')
            ->notEmpty('PaymentState');

        $validator
            ->add('OrderState', 'valid', ['rule' => 'numeric'])
            ->requirePresence('OrderState', 'create')
            ->notEmpty('OrderState');

        $validator
            ->add('Guest_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Guest_ID', 'create')
            ->notEmpty('Guest_ID');

        $validator
            ->add('Place_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Place_ID', 'create')
            ->notEmpty('Place_ID');

        $validator
            ->add('Payment_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Payment_ID', 'create')
            ->notEmpty('Payment_ID');

        $validator
            ->add('User_ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('User_ID');

        $validator
            ->add('TotalPrice', 'valid', ['rule' => 'decimal'])
            ->requirePresence('TotalPrice', 'create')
            ->notEmpty('TotalPrice');

        $validator
            ->add('OrderMain_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('OrderMain_ID', 'create')
            ->notEmpty('OrderMain_ID');

        return $validator;
    }
}

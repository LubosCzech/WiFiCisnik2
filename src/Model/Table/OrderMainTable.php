<?php
namespace App\Model\Table;

use App\Model\Entity\OrderMain;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderMain Model
 *
 */
class OrderMainTable extends Table
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

        $this->table('order_main');
        $this->displayField('ID');
        $this->primaryKey('ID');

        $this->belongsTo('Place');

        $this->belongsTo('States',[
            'propertyName' => 'orderSt',
            'foreignKey' => 'OrderState'
        ]);

        $this->hasMany('OrderGuest',[
            'foreignKey' => 'OrderMain_ID'
        ]);

        $this->belongsTo('User');

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
            ->add('OrderState', 'valid', ['rule' => 'numeric'])
            ->requirePresence('OrderState', 'create')
            ->notEmpty('OrderState');

        $validator
            ->add('OrdersCount', 'valid', ['rule' => 'numeric'])
            ->requirePresence('OrdersCount', 'create')
            ->notEmpty('OrdersCount');

        $validator
            ->add('Place_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Place_ID', 'create')
            ->notEmpty('Place_ID');

        $validator
            ->add('User_ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('User_ID');

        $validator
            ->add('Created', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('Created');

        return $validator;
    }
}

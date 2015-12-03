<?php
namespace App\Model\Table;

use App\Model\Entity\Menu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menu Model
 *
 */
class MenuTable extends Table
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

        $this->table('menu');
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
            ->add('Restaurant_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Restaurant_ID', 'create')
            ->notEmpty('Restaurant_ID');

        $validator
            ->add('Category_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Category_ID', 'create')
            ->notEmpty('Category_ID');

        $validator
            ->add('Product_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Product_ID', 'create')
            ->notEmpty('Product_ID');

        $validator
            ->add('Position', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Position', 'create')
            ->notEmpty('Position');

        return $validator;
    }
}

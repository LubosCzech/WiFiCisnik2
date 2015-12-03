<?php
namespace App\Model\Table;

use App\Model\Entity\Rating;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rating Model
 *
 */
class RatingTable extends Table
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

        $this->table('rating');
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
            ->requirePresence('Guest_Name', 'create')
            ->notEmpty('Guest_Name');

        $validator
            ->requirePresence('Comment', 'create')
            ->notEmpty('Comment');

        $validator
            ->add('Question1', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Question1');

        $validator
            ->add('Question2', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Question2');

        $validator
            ->add('Question3', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Question3');

        $validator
            ->add('Question4', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Question4');

        $validator
            ->add('Question5', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Question5');

        $validator
            ->add('Guest_ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Guest_ID');

        $validator
            ->add('Restaurant_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Restaurant_ID', 'create')
            ->notEmpty('Restaurant_ID');

        return $validator;
    }
}

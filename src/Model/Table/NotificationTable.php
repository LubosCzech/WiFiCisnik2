<?php
namespace App\Model\Table;

use App\Model\Entity\Notification;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notification Model
 *
 */
class NotificationTable extends Table
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

        $this->table('notification');
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
            ->add('Guest_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Guest_ID', 'create')
            ->notEmpty('Guest_ID');

        $validator
            ->add('Place_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Place_ID', 'create')
            ->notEmpty('Place_ID');

        $validator
            ->add('State', 'valid', ['rule' => 'numeric'])
            ->requirePresence('State', 'create')
            ->notEmpty('State');

        return $validator;
    }
}

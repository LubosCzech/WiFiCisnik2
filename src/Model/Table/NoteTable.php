<?php
namespace App\Model\Table;

use App\Model\Entity\Note;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Note Model
 *
 */
class NoteTable extends Table
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

        $this->table('note');
        $this->displayField('ID');
        $this->primaryKey('ID');

        $this->belongsTo('OrderGuest');

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
            ->add('OrderGuest_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('OrderGuest_ID', 'create')
            ->notEmpty('OrderGuest_ID');

        $validator
            ->requirePresence('Text', 'create')
            ->notEmpty('Text');

        $validator
            ->add('Guest_ID', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Guest_ID', 'create')
            ->notEmpty('Guest_ID');

        return $validator;
    }
}

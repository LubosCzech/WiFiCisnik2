<?php
namespace App\Model\Table;

use App\Model\Entity\Configuration;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Configuration Model
 *
 */
class ConfigurationTable extends Table
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

        $this->table('configuration');
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
            ->requirePresence('CurrencySign', 'create')
            ->notEmpty('CurrencySign');

        $validator
            ->requirePresence('WelcomeText', 'create')
            ->notEmpty('WelcomeText');

        $validator
            ->requirePresence('AdminText', 'create')
            ->notEmpty('AdminText');

        $validator
            ->requirePresence('PlaceText', 'create')
            ->notEmpty('PlaceText');

        $validator
            ->requirePresence('NoteTextHolder', 'create')
            ->notEmpty('NoteTextHolder');

        $validator
            ->add('Archive', 'valid', ['rule' => 'numeric'])
            ->requirePresence('Archive', 'create')
            ->notEmpty('Archive');

        $validator
            ->add('CashEnabled', 'valid', ['rule' => 'boolean'])
            ->requirePresence('CashEnabled', 'create')
            ->notEmpty('CashEnabled');

        $validator
            ->add('MPEnabled', 'valid', ['rule' => 'boolean'])
            ->requirePresence('MPEnabled', 'create')
            ->notEmpty('MPEnabled');

        $validator
            ->add('GPEnabled', 'valid', ['rule' => 'boolean'])
            ->requirePresence('GPEnabled', 'create')
            ->notEmpty('GPEnabled');

        $validator
            ->add('ShowMainBadges', 'valid', ['rule' => 'boolean'])
            ->requirePresence('ShowMainBadges', 'create')
            ->notEmpty('ShowMainBadges');

        $validator
            ->allowEmpty('Question1');

        $validator
            ->allowEmpty('Question2');

        $validator
            ->allowEmpty('Question3');

        $validator
            ->allowEmpty('Question4');

        $validator
            ->allowEmpty('Question5');

        return $validator;
    }
}

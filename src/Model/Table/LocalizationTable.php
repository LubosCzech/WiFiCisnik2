<?php
namespace App\Model\Table;

use App\Model\Entity\Localization;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Localization Model
 *
 */
class LocalizationTable extends Table
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

        $this->table('localization');
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
            ->requirePresence('Czech', 'create')
            ->notEmpty('Czech');

        $validator
            ->requirePresence('English', 'create')
            ->notEmpty('English');

        $validator
            ->requirePresence('German', 'create')
            ->notEmpty('German');

        $validator
            ->requirePresence('Slovak', 'create')
            ->notEmpty('Slovak');

        $validator
            ->requirePresence('Polish', 'create')
            ->notEmpty('Polish');

        return $validator;
    }
}

<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConfigurationFixture
 *
 */
class ConfigurationFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'configuration';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Restaurant_ID' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CurrencySign' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'WelcomeText' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'AdminText' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'PlaceText' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'NoteTextHolder' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Archive' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '24', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CashEnabled' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'MPEnabled' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'GPEnabled' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'ShowMainBadges' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'Question1' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Question2' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Question3' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Question4' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Question5' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'ID' => 1,
            'Restaurant_ID' => 1,
            'CurrencySign' => 'Lorem ip',
            'WelcomeText' => 'Lorem ipsum dolor sit amet',
            'AdminText' => 'Lorem ipsum dolor sit amet',
            'PlaceText' => 'Lorem ipsum dolor sit amet',
            'NoteTextHolder' => 'Lorem ipsum dolor sit amet',
            'Archive' => 1,
            'CashEnabled' => 1,
            'MPEnabled' => 1,
            'GPEnabled' => 1,
            'ShowMainBadges' => 1,
            'Question1' => 'Lorem ipsum dolor sit amet',
            'Question2' => 'Lorem ipsum dolor sit amet',
            'Question3' => 'Lorem ipsum dolor sit amet',
            'Question4' => 'Lorem ipsum dolor sit amet',
            'Question5' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}

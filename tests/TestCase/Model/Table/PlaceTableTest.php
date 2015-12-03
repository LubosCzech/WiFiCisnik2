<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlaceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlaceTable Test Case
 */
class PlaceTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.place',
        'app.checkout',
        'app.restaurant',
        'app.configuration',
        'app.news',
        'app.user',
        'app.order_main',
        'app.states',
        'app.order_guest',
        'app.product',
        'app.order_product',
        'app.payment',
        'app.note'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Place') ? [] : ['className' => 'App\Model\Table\PlaceTable'];
        $this->Place = TableRegistry::get('Place', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Place);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

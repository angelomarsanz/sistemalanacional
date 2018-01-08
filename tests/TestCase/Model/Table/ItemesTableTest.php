<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemesTable Test Case
 */
class ItemesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemesTable
     */
    public $Itemes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemes',
        'app.budgets',
        'app.patients',
        'app.users',
        'app.multilevels',
        'app.employees',
        'app.positions',
        'app.diarypatients',
        'app.patienthistories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Itemes') ? [] : ['className' => 'App\Model\Table\ItemesTable'];
        $this->Itemes = TableRegistry::get('Itemes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itemes);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

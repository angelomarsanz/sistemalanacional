<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MultilevelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MultilevelsTable Test Case
 */
class MultilevelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MultilevelsTable
     */
    public $Multilevels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.multilevels',
        'app.users',
        'app.patients',
        'app.diarypatients',
        'app.historypatients',
        'app.servicescontracts',
        'app.commissions',
        'app.dues',
        'app.hiredservices',
        'app.payments',
        'app.promoters',
        'app.supervisors',
        'app.employees',
        'app.positions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Multilevels') ? [] : ['className' => 'App\Model\Table\MultilevelsTable'];
        $this->Multilevels = TableRegistry::get('Multilevels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Multilevels);

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

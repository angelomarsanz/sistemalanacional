<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeesTable Test Case
 */
class EmployeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeesTable
     */
    public $Employees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employees',
        'app.users',
        'app.patients',
        'app.supervisors',
        'app.promoters',
        'app.vendors',
        'app.diarypatients',
        'app.historypatients',
        'app.servicescontracts',
        'app.commissions',
        'app.dues',
        'app.hiredservices',
        'app.payments',
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
        $config = TableRegistry::exists('Employees') ? [] : ['className' => 'App\Model\Table\EmployeesTable'];
        $this->Employees = TableRegistry::get('Employees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Employees);

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

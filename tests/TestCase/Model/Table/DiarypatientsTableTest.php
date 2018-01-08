<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiarypatientsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiarypatientsTable Test Case
 */
class DiarypatientsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DiarypatientsTable
     */
    public $Diarypatients;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.diarypatients',
        'app.budgets',
        'app.patients',
        'app.users',
        'app.multilevels',
        'app.employees',
        'app.positions',
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
        $config = TableRegistry::exists('Diarypatients') ? [] : ['className' => 'App\Model\Table\DiarypatientsTable'];
        $this->Diarypatients = TableRegistry::get('Diarypatients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Diarypatients);

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

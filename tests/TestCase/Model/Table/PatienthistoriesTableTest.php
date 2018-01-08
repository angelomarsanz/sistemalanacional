<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatienthistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatienthistoriesTable Test Case
 */
class PatienthistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PatienthistoriesTable
     */
    public $Patienthistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.patienthistories',
        'app.budgets',
        'app.patients',
        'app.users',
        'app.multilevels',
        'app.employees',
        'app.positions',
        'app.diarypatients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Patienthistories') ? [] : ['className' => 'App\Model\Table\PatienthistoriesTable'];
        $this->Patienthistories = TableRegistry::get('Patienthistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Patienthistories);

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

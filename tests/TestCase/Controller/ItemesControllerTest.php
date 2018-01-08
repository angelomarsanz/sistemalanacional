<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ItemesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ItemesController Test Case
 */
class ItemesControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

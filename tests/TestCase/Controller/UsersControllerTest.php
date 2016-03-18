<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */

    /* Not implemented...
    public $fixtures = [
        'app.users'
    ];
     */

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

    /**
     * Test logout method
     *
     * @return void
     */
    public function testLogout()
    {
        $this->session($this->_setUserSession());
        $this->get('/users/logout');
        $this->assertRedirect([
            'controller' => 'Pages',
            'action' => 'top'
        ]);
    }

    /**
     * Login method in test
     *
     * @return array
     */
    protected function _setUserSession()
    {
        return [
            'Auth' => [
                'User' => [
                    'id' => 100,
                    'email' => 'john.doe@crm.com',
                    'name' => 'testuser',
                    'created' => '2015-04-01 22:26:51',
                    'modified' => '2015-04-01 22:26:51'
                ]
            ]
        ];
    }
}

<?php

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\DashboardController Test Case
 */
class DashboardControllerTest extends IntegrationTestCase
{
    /**
     * testIndex method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session($this->_setUserSession());
        $this->get('/dashboard');
        $this->assertResponseOk();
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

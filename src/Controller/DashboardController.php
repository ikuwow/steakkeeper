<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Dashboard (main view) controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class DashboardController extends AppController
{
    /**
     * beforeFilter
     *
     * @param Event $event An Event instance
     * @return void \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * dashboard (main login view)
     *
     * @return void
     */
    public function index()
    {
    }
}

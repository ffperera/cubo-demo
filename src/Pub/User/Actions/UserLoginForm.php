<?php

declare(strict_types=1);

namespace App\Pub\User\Actions;

use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\View;

class UserLoginForm extends Action
{
    public function __construct() {}

    public function run(Controller $controller): void
    {
        
        // check for User fields

        /**
         * @var \FFPerera\Cubo\Request $request
         */
        $request = $controller->getRequest();

        $email = '';
        $password = '';

        if ($request->method() === 'POST') {
            $email = $request->post('username');
            $password = $request->post('password');
        } 


        $view = $controller->getView();
        $view->setLayout('/Pub/layout/main.php');
        $view->setTemplate('main', '/Pub/layout/login.php');

    }    

}
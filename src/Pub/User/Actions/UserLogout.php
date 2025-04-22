<?php

declare(strict_types=1);

namespace App\Pub\User\Actions;

use App\Pub\User\Model\User;
use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\Response;


class UserLogout extends Action
{
    public function __construct() {}

    public function run(Controller $controller): void
    {

        $logger = $controller->logger();
        $logger->debug('UserLogout action');

        $session = $controller->get('SESSION');
        $session->destroy();

        // redirect to home page
        (new Response(''))->redirect('/');
    }
}

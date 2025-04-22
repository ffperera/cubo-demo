<?php

declare(strict_types=1);

namespace App\Pub\User\Actions;

use App\Pub\User\Repository\IUserRepository;
use App\Pub\User\Model\User;
use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\View;


class UserRegister extends Action
{
    public function __construct(private IUserRepository $repo) {}

    public function run(Controller $controller): void
    {

        $badInputData = false;

        /**
         * @var \FFPerera\Cubo\Request $request
         */
        $request = $controller->getRequest();

        $email = '';
        $password = '';

        if ($request->method() === 'POST') {
            $email = $request->post('username') ?? '';
            $password = $request->post('password') ?? '';
        }

        if ($email === '') {
            $badInputData = true;
        }

        if (strlen($password) < 6) {
            $badInputData = true;
        }

        if (!$badInputData) {
            $user = new User('user name', $email, $password);

            // initialize the repository with the PDO connection
            try {
                $this->repo->init(['PDO' => $controller->get('PDO')]);
                $this->repo->add($user);
                $badInputData = false;
            } catch (\Exception $e) {
                // TODO: handle the exception
                $badInputData = true;
                $logger = $controller->logger();
                $logger->error('UserRegister: ' . $e->getMessage());
            }
        }

        $view = $controller->getView();

        if ($badInputData) {
            $view->set('error-msg', 'Invalid input data');
            $view->set('email', $email);

            // don't send the password back to the view
            // $view->set('password', $password);

            $view->setLayout('/Pub/layout/main.php');
            $view->setTemplate('main', '/Pub/layout/register.php');
        } else {
            // 
            $view->set('success-msg', 'User registered successfully');
            $view->setLayout('/Pub/layout/main.php');
            $view->setTemplate('main', '/Pub/layout/login.php');
        }
    }
}

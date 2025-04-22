<?php

declare(strict_types=1);

namespace App\Pub\User\Actions;

use App\Pub\User\Repository\IUserRepository;
use App\Pub\User\Model\User;
use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\Response;


class UserLogin extends Action
{
    public function __construct(private IUserRepository $repo) {}

    public function run(Controller $controller): void
    {

        $logger = $controller->logger();
        $logger->debug('inside UserLogin action');

        $badInputData = false;

        /**
         * @var \FFPerera\Cubo\Request $request
         */
        $request = $controller->getRequest();

        $email = '';
        $password = '';

        if ($request->method() === 'POST') {
            $email = trim($request->post('username') ?? '');
            $password = trim($request->post('password') ?? '');
        }

        if ($email === '') {
            $badInputData = true;
        }

        if (strlen($password) < 6) {
            $badInputData = true;
        }

        $user = null;

        if (!$badInputData) {

            // initialize the repository with the PDO connection
            try {
                $this->repo->init(['PDO' => $controller->get('PDO')]);
                $user = $this->repo->getUserByUsernameAndPassword($email, $password);

                if ($user instanceof User) {
                    $badInputData = false;
                } else {
                    $badInputData = true;
                }
            } catch (\Exception $e) {
                // TODO: handle the exception

                $logger->error('UserRegister: ' . $e->getMessage());
                $badInputData = true;
            }
        }

        $view = $controller->getView();

        if ($badInputData) {
            $view->set('error-msg', 'Invalid credentials, please try again');

            $view->setLayout('/Pub/layout/main.php');
            $view->setTemplate('main', '/Pub/layout/login.php');
        } else {

            $session = $controller->get('SESSION');

            if ($session === null) {
                $logger->error('UserLogin: session not found');
                throw new \Exception('Session not found');
            } else {
                $session->set('user', $user);
                $session->set('loggedin', true);
            }

            // redirect to home page
            (new Response(''))->redirect('/');
        }
    }
}

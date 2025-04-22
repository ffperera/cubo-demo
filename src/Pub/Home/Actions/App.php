<?php

declare(strict_types=1);

namespace App\Pub\Home\Actions;

use App\Pub\Post\Repository\IPostRepository;
use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\View;

class App extends Action
{
  public function __construct(private IPostRepository $repo) {}

  public function run(Controller $controller): void
  {
    // Implement the logic for the Home action here

    // show list of posts in the home page
    // initialize the repository with the PDO connection
    try {
      $this->repo->init(['PDO' => $controller->get('PDO')]);
    } catch (\Exception $e) {
      // TODO: handle the exception
    }

    /**
     * @var \FFPerera\Cubo\View $view
     */
    $view = $controller->getView();

    $view->set('posts', $this->repo->getPosts());

    $view->setLayout('/Pub/layout/main.php');
    $view->setTemplate('main', '/Pub/layout/home.php');

    $view->set('title', 'HOME PAGE');
    $view->setTemplate('post_list', '/Pub/layout/post_list.php');

    $view->set('saludo', 'Hello, welcome to the app!');
    $view->set('metatitle', 'Title!');
    $view->set('metadesc', 'This is the description!');
    $view->set('canonical', '/');
  }
}

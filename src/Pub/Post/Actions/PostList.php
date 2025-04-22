<?php

declare(strict_types=1);

namespace App\Pub\Post\Actions;

use App\Pub\Post\Repository\IPostRepository;
use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\View;

class PostList extends Action
{
  public function __construct(private IPostRepository $repo) {}

  public function run(Controller $controller): void
  {
    
    // initialize the repository with the PDO connection
    try {
        $this->repo->init(['PDO' => $controller->get('PDO')]);
    }
    catch (\Exception $e) {
        // TODO: handle the exception
    }

    // fetch posts from the repository
    $posts = $this->repo->getPosts();

    $view = $controller->getView();

    $view->set('posts', $posts);

    $view->set('title', 'POSTS');
    $view->set('post-list-intro', 'This is the list of posts');


    $view->setLayout('/Pub/layout/main.php');
    $view->setTemplate('main', '/Pub/layout/post_list.php');
    
    $view->set('metatitle', 'List of Posts');
    $view->set('metadesc', 'Published posts');
    $view->set('canonical', '/blog/');    

  }

}
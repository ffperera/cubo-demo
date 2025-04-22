<?php

declare(strict_types=1);

namespace App\Pub\Home\Actions;

use App\Pub\Post\Repository\IPostRepository;
use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Cubo\View;

class About extends Action
{
  public function __construct() {}

  public function run(Controller $controller): void
  {

    /**
     * @var \FFPerera\Cubo\View $view
     */
    $view = $controller->getView();


    // the about page is static, 
    // so we only need to set the template, title and meta tags
    $view->setLayout('/Pub/layout/main.php');
    $view->setTemplate('main', '/Pub/layout/about.php');

    $view->set('title', 'About Cubo Demo');

    $view->set('metatitle', 'About Cubo Demo');
    $view->set('metadesc', 'Cubo Demo is a simple application to demonstrate the use of Cubo framework');
    $view->set('canonical', '/about/');
  }
}

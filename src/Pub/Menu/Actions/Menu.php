<?php

declare(strict_types=1);

namespace App\Pub\Menu\Actions;

use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;


class Menu extends Action
{
  public function __construct() {}

  public function run(Controller $controller): void
  {
    // Implement the logic for the Home action here

    $view = $controller->getView();

    $view->setTemplate('menu', '/Pub/layout/menu.php');

    $menu = [
      'home' => [
        'label' => 'Home',
        'url' => '/',
      ],
      'about' => [
        'label' => 'About',
        'url' => '/about/',
      ],
    ];

    // check if active user in session
    $session = $controller->get('SESSION');
    if ($session->get('user')) {

      $menu['logout'] = [
        'label' => 'Logout',
        'url' => '/logout/',
      ];
    } else {
      $menu['login'] = [
        'label' => 'Login',
        'url' => '/login/',
      ];
      $menu['register'] = [
        'label' => 'Register',
        'url' => '/register/',
      ];
    }

    $view->set('menu', $menu);



    // testing latte template engine
    if ($view->isset('latte')) {
      $latte = $view->get('latte');
    } else {
      $latte = [];
    }

    $latte['menu'] = $menu;
    $view->set('latte', $latte);
  }
}

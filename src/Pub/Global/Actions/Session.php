<?php

declare(strict_types=1);

namespace App\Pub\Global\Actions;

use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;
use FFPerera\Lib\Session as EngSession;

class Session extends Action
{
  public function __construct(private EngSession $session) {}

  public function run(Controller $controller): void
  {
    // inject the session into the controller
    $this->session->start();
    $controller->set('SESSION', $this->session);
  }
}

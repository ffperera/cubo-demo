<?php

namespace FFPerera\Lib;

use FFPerera\Cubo\Response;
use Latte\Engine;

class LatteRender extends \FFPerera\Cubo\Render
{
    private Engine $latte;


    public function __construct(private \FFperera\Cubo\View $view, private string $templateDir, private bool $autorefresh = true)
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory($this->templateDir . '/cache');
        $this->latte->setAutoRefresh($this->autorefresh);
    }



    public function render(): Response
    {

        $template = trim($this->view->get('templatte'));
        $params = $this->view->get('latte') ?? [];

        return new Response($this->latte->renderToString($this->templateDir . '/' . $template, $params));
    }

    public function send(): void
    {
        $template = trim($this->view->get('templatte'));
        $params = $this->view->get('latte') ?? [];

        echo $this->latte->renderToString($this->templateDir . '/' . $template, $params);
    }
}

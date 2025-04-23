<?php


require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../src/config/routing.php';

$srcDir = dirname(__DIR__) . '/src';


use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

use FFPerera\Cubo\Controller;
use FFPerera\Cubo\Render;

$logger = new \Monolog\Logger('app');
// $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/logs/app.log', \Monolog\Level::Debug));
$logger->pushHandler(new \Monolog\Handler\StreamHandler("php://stdout", \Monolog\Level::Debug));


$controller = new Controller($routes, $logger);

try {
    $view = $controller->run();

    if ($view && $view instanceof \FFPerera\Cubo\View) {

        if ($view->isset('templatte')) {
            $render = new \FFPerera\Lib\LatteRender($view, dirname($srcDir) . '/latte', true);
        } else {
            $render = new Render($view, $srcDir);
        }

        $render->send();
    }
} catch (Exception $e) {
    // TODO: catch every posible exception

    // Handle exceptions and errors
    echo 'Error: ' . $e->getMessage();
}

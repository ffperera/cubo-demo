<?php

declare(strict_types=1);

// front controller / access point

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../src/config/routing.php';

$srcDir = dirname(__DIR__) . '/src';


use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

use FFPerera\Cubo\Controller;
use FFPerera\Cubo\Render;
use FFPerera\Cubo\Response;


$logger = new \Monolog\Logger('app');
// $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/logs/app.log', \Monolog\Level::Debug));
$logger->pushHandler(new \Monolog\Handler\StreamHandler("php://stdout", \Monolog\Level::Debug));



try {

    $controller = new Controller($routes, $logger, true);

    $view = $controller->run();

    if ($view && $view instanceof \FFPerera\Cubo\View) {

        // check if it is a template for latte
        // this is a hack, because this is a sample project
        // a real project probably will work with only one template engine
        if ($view->isset('templatte')) {
            $render = new \FFPerera\Lib\LatteRender($view, dirname($srcDir) . '/latte', true);
        } else {
            $render = new Render($view, $srcDir);
        }

        $render->send();
    }
} catch (\FFPerera\Cubo\Exceptions\NotFoundException $e) {

    // Handle 404 error
    (new Response('404 Not Found', [
        'Content-Type' => 'text/html; charset=utf-8',
        'X-Powered-By' => 'Cubo',
        'statusCode' => 404,
        'statusText' => 'Not Found',
        'protocolVersion' => '1.1',
    ]))->send();
} catch (\FFPerera\Cubo\Exceptions\RoutesNotDefinedException $e) {
    // Handle 404 error
    (new Response('404 Not Found - Routes not defined', [
        'Content-Type' => 'text/html; charset=utf-8',
        'X-Powered-By' => 'Cubo',
        'statusCode' => 404,
        'statusText' => 'Routes not defined',
        'protocolVersion' => '1.1',
    ]))->send();
} catch (Exception $e) {
    // TODO: catch every posible exception

    // Handle exceptions and errors
    echo 'Error: ' . $e->getMessage();
}

<?php

declare(strict_types=1);


$routes = [


    // this is a section
    // sections are independent zones of the application: admin, app, api ...
    // they could be separated as micro services if needed
    // each section has its own routes    

    'app' => [

        // this is a route
        // a route is managed by an Action
        // the action is inside a module that could include also the model,the view, data layer and so on        
        'home' => [
            'action' => new App\Pub\Home\Actions\App(new App\Pub\Post\Repository\PostRepositoryPDO()),
            'path' =>   '/',
            'method' => 'GET',
        ],
        'about' => [
            'action' => new App\Pub\Home\Actions\About(),
            'path' =>   '/about/',
            'method' => 'GET',
        ],
        'blogpost' => [
            // this is a route with a param (ID, slut...)
            'action' => new App\Pub\Post\Actions\PostList(new App\Pub\Post\Repository\PostRepositoryPDO()),
            'path' =>   '/blog/{id}/',
            'method' => 'GET',
        ],
        'blog' => [
            'action' => new App\Pub\Post\Actions\PostList(new App\Pub\Post\Repository\PostRepositoryPDO()),
            'path' =>   '/blog/',
            'method' => 'GET',
        ],
        'user-add' => [
            'action' => new App\Pub\User\Actions\UserRegisterForm(),
            'path' =>   '/register/',
            'method' => 'GET',
        ],
        'user-add-sav' => [
            'action' => new App\Pub\User\Actions\UserRegister(new App\Pub\User\Repository\UserRepositoryPDO()),
            'path' =>   '/register/',
            'method' => 'POST',
        ],
        'login' => [
            'action' => new App\Pub\User\Actions\UserLoginForm(),
            'path' =>   '/login/',
            'method' => 'GET',
        ],
        'login-in' => [
            'action' => new App\Pub\User\Actions\UserLogin(new App\Pub\User\Repository\UserRepositoryPDO()),
            'path' =>   '/login/',
            'method' => 'POST',
        ],
        'logout' => [
            'action' => new App\Pub\User\Actions\UserLogout(),
            'path' =>   '/logout/',
            'method' => 'GET',
        ],

        // this is an array of actions that will be executed before the main action
        // theese actions can be middleware, preconditions, filters, etc.
        'PRE' => [
            new App\Pub\Global\Actions\Session(new \FFPerera\Lib\Session(1800)),
            new App\Pub\PDO\Actions\PDOConnection(),  // inject the PDO connection (using the Adm one)
            new App\Pub\Menu\Actions\Menu()
        ],

        // this is an array of actions that will be executed after the main action
        // for example to garbage collect, log, etc.
        // take into account that if some main Action do a redirect, the POS queue will not be executed
        'POS' => [],
    ],


];

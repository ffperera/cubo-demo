# Cubo

Cubo is a lightweight PHP framework designed for building web applications with simplicity and flexibility.

**NOTE**: While Cubo can certainly be used in real-world production projects, there are more established frameworks with strong community support like [Symfony](https://symfony.com/) and [Laravel](https://laravel.com/). We recommend considering these alternatives for enterprise-level applications requiring extensive ecosystem support.

## Requirements

- PHP 8.1 or higher
- Composer

## Installation

Install using Composer:

```bash
composer install ffperera/cubo
```

### Demo structure

A Cubo-based project can be organized in countless ways. The framework is intentionally project-structure agnostic. You’re free to adopt whatever project layout best suits your needs, and you can use external components, packages, or services as required.

In this demo we use this folder structure:

```
├── dev
│   └── scss
├── root
│   └── assets
│   │   └── pub
│   │       └── css
│   └── index.php
├── src
│   ├── config
│   │   └── routing.php
│   └── Pub
│       ├── Global
│       │   └── Actions
│       ├── Home
│       │   └── Actions
│       ├── Menu
│       │   └── Actions
│       ├── User
│       │   └── Actions (Register, Login ...)
│       │
│       ├── ... other modules
│       │
│       └── layout  (PHP templates)

```

### Entry point

The app entry point is **/root/index.php**

This file is located in the **public** directory (root folder) of the HTTP server.

Public resources and assets like images and CSS files should be placed in the **/root** directory.

All other folders reside outside the root directory and cannot be accessed directly from external sources.

### Sections

In this example we are working with a single section: `Pub`

Every section can maintain its own layouts, actions, data layers, etc.

### Actions

An `Action` is a class that performs specific tasks.

To perform a complex taks, e.g. send a Response based on a Request, we can chain multiple Actions.

So, in Cubo we could...

- Define action sequences (e.g., using a routing file) to handle requests
- Implement controller-like actions that manage request-specific operations
- Create middleware actions that execute before primary actions
- Utilize actions for dependency injection

### Main Controller

The `Controller` object acts as Cubo's engine.

It handles:

- Request routing management
- Action queue
- Dependency injection (e.g., services)
- Access to core Cubo components (`Request`, `View`, `Render`, `Response`)

Once configured, the application primarily operates through the `Controller::run()` method called at the entry point (e.g. `/root/index.php`).

The Controller also manage three Action queues:

- _pre_: Handles setup tasks, dependency injections, and middleware tasks
- _main_: _Controller-like_ actions tied to specific routes
- _pos_: Manages cleanup operations if needed

The queues are dynamic: from inside an Action we can append new Actions on demand.

For example, if a request can not be solved or fails something, we can append fallback actions and abort the actual sequence.

### Routing

In this demo, routes are defined in the `config/routing.php` file as an array.

The routing array contains:

- All possible entry points for each section
- Associated actions for pre and pos queues

A route example:

```php
'user-add' => [
    'action' => new App\Pub\User\Actions\UserRegisterForm(),
    'path' =>   '/register/',
    'method' => 'GET',
],
```

### View

The object View manage the main layout and all the templates needed to format the data sent to the client.

It includes also a `bag` to hold all the objects and variables needed by the templates.

```php

// inside the Action::run() method
$view = new View();
$view->setLayout('layout.php');
$view->setTemplate('content', 'content.php');

$view->set('someVar', $someVar);

// inside the template
echo $thisView->get('someVar');

```

### Render

The **Render** object is responsible for rendering views and layouts.

We can render directly to the client or render to a `Response` object depending on our needs.

```php

$render = new Render($view, $srcDir);

// send to the client
$render->send();

// generate a Response object
$response = $render->render()
    ->withHeader('X-Custom-One', 'Hi!')
    ->send();

```

### Response

The **Response** class allows you to manage HTTP headers, status codes, and redirections.

```php
$response = new Response('{"key": "value"}', $options =[
        'headers' => [
            'Content-Type' => 'application/json; charset=UTF-8',
        ],
        'statusCode' => 200,
        'statusText' => 'OK',
        'protocolVersion' => '1.1',
]);

$response = $response->withHeader('X-Custom-Header', 'CustomValue');

$response->send();
```

The Response class implements the PSR-7 interface.

## Demo details

This demo uses a very basic database schema, designed solely to test the data layer.

We are using PDO as the abstraction layer here, but you are free to use more advanced abstractions or even ORM packages if desired (though this might go against the minimalist philosophy of Cubo).

Also, we are using here PHP templates (HTML with PHP code inside), but we could write our own custom Render subclass to integrate a template engine (like [Latte](https://latte.nette.org/en/) o [Smarty](https://www.smarty.net/)).

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

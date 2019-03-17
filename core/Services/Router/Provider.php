<?php

namespace Core\Services\Router;

use Modules\Auth\Controller\AuthController;
use Modules\Profile\Controllers\ProfileController;
use Modules\Register\Controller\RegisterController;
use Core\Services\AbstractServiceProvider;
use FastRoute\RouteCollector;
use Modules\Page\Controllers\PageController;

class Provider extends AbstractServiceProvider
{

    protected $name = 'routes';

    public function init()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $r) {
            //$r->addRoute('GET', '/users', 'get_all_users_handler');
            // {id} must be a number (\d+)
            //$r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
            $r->addRoute('GET', '/account', [ProfileController::class, 'account']);
            $r->addRoute('GET', '/profile', [ProfileController::class, 'index']);
            $r->addRoute('POST', '/signin', [AuthController::class, 'complete']);
            $r->addRoute('GET', '/login', [AuthController::class, 'index']);
            $r->addRoute('POST', '/signup', [RegisterController::class, 'complete']);
            $r->addRoute('GET', '/registration', [RegisterController::class, 'index']);
            $r->addRoute('GET', '/', [PageController::class, 'index']);
        });
        $this->container->set($this->name , $dispatcher);

    }
}

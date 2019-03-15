<?php

namespace Core\Services\Router;


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
            // The /{title} suffix is optional
            //$r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
            $r->addRoute('GET', '/', [PageController::class, 'index']);
        });
        $this->container->set($this->name , $dispatcher);

    }
}
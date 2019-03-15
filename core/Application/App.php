<?php

namespace Core\Application;

use Acclimate\Container\ContainerAcclimator;
use Acclimate\Container\CompositeContainer;
use DI\ContainerBuilder;
use Core\Components\Router\Router;
use Pimple\Container;

class App
{
    protected static $instance = null;

    protected static $container = [];

    protected $request;

    /**
     * App constructor.
     * @param Container $container
     */
    private function __construct($container)
    {
        self::$container = $container;

        $this->setServiceProviders($container);
    }

    /**
     * @param Container $container
     * @return App|null
     */
    public static function geiInstance($container)
    {
        if(!self::$instance) {
            return new self($container);
        }
        return self::$instance;
    }

    /**
     * @param $container
     */
    private function setServiceProviders($container)
    {
        $services = require_once CONFIG_DIR . '/services.php';

        foreach($services as $service) {
            $provider = new $service($container);
            $provider->init();
        }
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        if(isset(self::$container[$name])) {
            return self::$container[$name];
        }
        return null;
    }

    public function start()
    {

        $this->dispatch();

        //require_once CONFIG_DIR . '/routes.php';

        //Router::dispatch($this->get('request'), $this->get('response'));
    }

    private function dispatch()
    {
        $request = self::$container->make('request');
        $httpMethod = $request->getMethod();
        $uri = $request->getUriString();

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = self::$container->make('routes')->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                throw new \Exception("404 Not Found");
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                throw new \Exception("405 Method Not Allowed" . $allowedMethods) ;
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                self::$container->call($handler, $vars);
                break;
        }
    }
}
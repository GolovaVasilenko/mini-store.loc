<?php

namespace Core\Application;


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
    private function __construct(Container $container)
    {
        self::$container = $container;

        $this->setServiceProviders($container);
    }

    /**
     * @param Container $container
     * @return App|null
     */
    public static function geiInstance(Container $container)
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
        require_once CONFIG_DIR . '/routes.php';

        Router::dispatch($this->get('request'), $this->get('response'));
    }
}
<?php

namespace Core\Application;


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
        $this->request = self::$container->make('request');
        $this->request->setMethod($_SERVER["REQUEST_METHOD"]);
        $this->request->setUri($_SERVER['REQUEST_URI']);

        $this->dispatch();
    }

    private function dispatch()
    {
        $uri = $this->request->getUriString();

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = self::$container->make('routes')->dispatch($this->request->getMethod(), $uri);

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

                $response = self::$container->make('response');
                $response->setStatusCode(http_response_code());
                $response->setContent(self::$container->call($handler, $vars));
                echo $response->getBody();
                break;
        }
    }
}

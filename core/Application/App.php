<?php

namespace Core\Application;


use Pimple\Container;

class App
{
    protected static $instance = null;

    protected static $container = [];

    private function __construct(Container $container)
    {
        self::$container = $container;
    }

    public static function geiInstance(Container $container)
    {
        if(!self::$instance) {
            return new self($container);
        }
        return self::$instance;
    }

    public function start()
    {
        echo 'My start ready';
    }
}
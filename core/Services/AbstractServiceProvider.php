<?php

namespace Core\Services;

use Core\Application\App;

abstract class AbstractServiceProvider
{
    protected $container = [];

    public function __construct(App $container)
    {
        $this->container = $container;
    }

    abstract public function init();
}
<?php

namespace Core\Services;

abstract class AbstractServiceProvider
{
    protected $container = [];

    public function __construct($container)
    {
        $this->container = $container;
    }

    abstract public function init();
}
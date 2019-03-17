<?php

namespace Core\Services\Auth;


use Core\Components\Auth\AuthComponent;
use Core\Services\AbstractServiceProvider;

class Provider extends AbstractServiceProvider
{
    protected $name = 'auth';

    public function init()
    {
        $this->container->set($this->name, \DI\create(AuthComponent::class));
    }
}

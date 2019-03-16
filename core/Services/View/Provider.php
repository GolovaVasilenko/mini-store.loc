<?php

namespace Core\Services\View;


use Core\Services\AbstractServiceProvider;
use Core\View\View;

class Provider extends AbstractServiceProvider
{
    protected $name = 'view';

    public function init()
    {
        $this->container->set($this->name , \DI\create(View::class));
    }
}

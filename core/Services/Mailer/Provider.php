<?php

namespace Core\Services\Mailer;


use Core\Components\Mailer\Mailer;
use Core\Services\AbstractServiceProvider;

class Provider extends AbstractServiceProvider
{

    protected $name = 'mailer';

    public function init()
    {
        $this->container->set($this->name, \DI\create(Mailer::class));
    }
}

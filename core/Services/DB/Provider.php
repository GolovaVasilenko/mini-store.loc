<?php

namespace Core\Services\DB;


use Core\DB\DbConnect;
use Core\Services\AbstractServiceProvider;

class Provider extends AbstractServiceProvider
{
    protected $name = 'db';

    public function init()
    {
        $this->container->set($this->name , \DI\create(DbConnect::class));
    }
}

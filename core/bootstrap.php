<?php

if(!PRODUCTION){
    ini_set('display_errors', 1);
}
else {
    ini_set('display_errors', 0);
}

use Core\Application\App;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

//$builder->enableCompilation(ROOT . '/tmp/cache/container');

$app = App::getInstance($builder->build());

try {
    $app->start();
}
catch (\Exception $e) {
    echo $e->getMessage();
}catch (\PDOException $PDOException) {
    echo $PDOException->getMessage();
}

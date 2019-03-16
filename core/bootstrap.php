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

$app = App::geiInstance($builder->build());

try {
    $app->start();
}
catch (\Exception $e) {
    echo $e->getMessage();
}catch (\PDOException $PDOException) {
    echo $PDOException->getMessage();
}

<?php

if(!PRODUCTION){
    ini_set('display_errors', 1);
}
else {
    ini_set('display_errors', 0);
}

use Pimple\Container;
use Core\Application\App;
$pimple = new Container();

$app = App::geiInstance($pimple);

try {
    $app->start();
}
catch (\Exception $e) {
    echo $e->getMessage();
}

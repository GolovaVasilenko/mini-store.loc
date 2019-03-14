<?php

if(!PRODUCTION){
    ini_set('display_errors', 1);
}
else {
    ini_set('display_errors', 0);
}

use Pimple\Container;
use Core\Application\App;

$container = new Container();

$app = App::geiInstance($container);

try {

}
catch (\Exception $e) {
    echo $e->getMessage();
}

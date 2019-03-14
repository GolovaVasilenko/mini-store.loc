<?php

if(!session_status()) {
    session_start();
}

require_once __DIR__ . '/../config/init.php';

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../core/bootstrap.php';
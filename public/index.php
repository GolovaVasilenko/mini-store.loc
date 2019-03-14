<?php

if(!session_status()) {
    session_start();
}

require_once CONFIG_DIR . '/init.php';

require_once CORE_DIR . '/bootstrap.php';
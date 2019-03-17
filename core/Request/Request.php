<?php

namespace Core\Request;

class Request extends \Zend\Http\Request
{
    public function __construct()
    {
        $this->setMethod($_SERVER["REQUEST_METHOD"]);
        $this->setUri($_SERVER['REQUEST_URI']);

        switch($this->getMethod()) {
            case 'POST':
                foreach($_POST as $key => $item){
                    $this->getPost()->set($key, $item);
                }
                break;
        }
    }

}

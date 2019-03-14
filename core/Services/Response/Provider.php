<?php

/*
 *
 * $response = new Response();
    $response->setStatusCode(Response::STATUS_CODE_200);
    $response->getHeaders()->addHeaders([
    'HeaderField1' => 'header-field-value',
    'HeaderField2' => 'header-field-value2',
]);
$response->setContent($bodyHtml);
 *
 * */

namespace Core\Services\Response;
use Core\Services\AbstractServiceProvider;
use Zend\Http\Response;

class Provider extends AbstractServiceProvider
{
    protected $name = 'response';

    public function init()
    {
        $this->container[$this->name] = function($c) {
            $response = new Response();

            return $response;
        };
    }
}
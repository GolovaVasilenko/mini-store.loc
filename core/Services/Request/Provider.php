<?php

/*
 * $request->setMethod(Request::METHOD_POST);
$request->setUri('/foo');
$request->getHeaders()->addHeaders([
    'HeaderField1' => 'header-field-value1',
    'HeaderField2' => 'header-field-value2',
]);
$request->getPost()->set('foo', 'bar');
*/

namespace Core\Services\Request;


use Core\Services\AbstractServiceProvider;
use Zend\Http\Request;

class Provider extends AbstractServiceProvider
{
    protected $name = 'request';

    public function init()
    {
       $this->container[$this->name] = function($c) {
           $request = new Request();

           return $request;
       };
    }
}
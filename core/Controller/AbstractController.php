<?php

namespace Core\Controller;

use Core\Application\App;
use Core\Components\Auth\AuthComponent;
use Core\View\View;

abstract class AbstractController
{
    protected $view;

    protected $viewObj;

    protected $viewPath = '';

    protected $request;

    protected $moduleName = '';

    protected $controllerName = '';

    protected $auth;

    public function __construct(View $view, AuthComponent $auth)
    {
        $this->controllerName = get_called_class();
        $this->callModuleName();
        $this->request = App::get('request');
        $this->viewObj = $view;
        $this->auth = $auth;
        $this->view = $this->viewObj->getView();
    }

    private function callModuleName()
    {
        $parts = explode('\\', $this->controllerName);
        $this->moduleName = ROOT . '/' .lcfirst($parts[0]) . '/' . $parts[1];

        $this->viewPath = $this->moduleName . '/views';
    }
}

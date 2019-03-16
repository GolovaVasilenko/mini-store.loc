<?php

namespace Core\Controller;

use Core\View\View;
use Zend\Http\Request;

abstract class AbstractController
{
    protected $view;

    protected $viewObj;

    protected $viewPath = '';

    protected $request;

    protected $moduleName = '';

    protected $controllerName = '';

    public function __construct(View $view, Request $request)
    {
        $this->controllerName = get_called_class();
        $this->callModuleName();
        $this->request = $request;
        $this->viewObj = $view;

        $this->view = $this->viewObj->getView();

    }

    private function callModuleName()
    {
        $parts = explode('\\', $this->controllerName);
        $this->moduleName = ROOT . '/' .lcfirst($parts[0]) . '/' . $parts[1];

        $this->viewPath = $this->moduleName . '/views';
    }
}

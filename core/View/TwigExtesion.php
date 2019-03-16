<?php

namespace Core\View;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\CoreExtension;

/*class TwigExtension extends CoreExtension implements GlobalsInterface {

    public function getName() {
        return 'twigExtension';
    }

    public function getFunctions()
    {
        return [
            new \Twig_Function( 'formLogin', [ $this, 'formLogin' ] ),
            new \Twig_Function( 'flash', [ $this, 'flash' ] ),
        ];
    }

    public function formLogin()
    {
        return LoginForms::renderLoginForm();
    }
    public function flash($key)
    {
        return Session::flash($key);
    }

    public function getGlobals() {
        return [
            'config' => Config::file('main'),
            'assetsPath' => '/www/assets/',
        ];
    }
}*/

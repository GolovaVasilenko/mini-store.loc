<?php

namespace Modules\Profile\Controllers;

use Core\Components\Auth\AuthComponent;
use Core\Controller\AbstractController;
use Core\View\View;

class ProfileController extends AbstractController
{
    protected  $idUser;

    public function __construct(View $view, AuthComponent $auth)
    {
        parent::__construct($view, $auth);
        if (!$this->auth->getInstance()->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    public function account()
    {
        $this->idUser = $this->auth->getInstance()->getUserId();
        echo 'User is signed in ' . $this->idUser;
    }
}

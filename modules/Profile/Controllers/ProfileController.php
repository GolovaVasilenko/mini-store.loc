<?php

namespace Modules\Profile\Controllers;

use Core\Controller\AbstractController;

class ProfileController extends AbstractController
{
    protected  $idUser;

    public function index()
    {
        if ($this->auth->getInstance()->isLoggedIn()) {
            $this->redirect('/account');
        }
        else {
            $this->redirect('/login');
        }
    }

    public function account()
    {
        $this->idUser = $this->auth->getInstance()->getUserId();
        echo 'User is signed in ' . $this->idUser;
    }
}

<?php

namespace Modules\Auth\Controller;


use Core\Controller\AbstractController;

class AuthController extends AbstractController
{
    public function index()
    {
        return $this->view->render('page/auth.twig');
    }

    public function complete()
    {
        if($this->request->isPost()) {
            $post = $this->request->getPost();
            $this->auth->login($post);
        }

        $this->redirect('/profile');
    }

    public function logout()
    {
        $this->auth->logout();
    }

}

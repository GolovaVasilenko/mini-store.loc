<?php

namespace Modules\Register\Controller;

use Core\Controller\AbstractController;

class RegisterController extends AbstractController
{
    public function index()
    {
        return $this->view->render('register/register.twig');
    }

    public function complete()
    {
        if($this->request->isPost()) {
            $post = $this->request->getPost();
            $userId = $this->auth->registration($post);
            return $this->view->render('page/register-complete.twig');
        }
        return $this->redirect('/registration');

    }

}

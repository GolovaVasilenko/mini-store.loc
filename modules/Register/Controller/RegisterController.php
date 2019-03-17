<?php


namespace Modules\Register\Controller;


use Core\Components\Auth\AuthComponent;
use Core\Controller\AbstractController;
use Core\View\View;
use Zend\Http\Request;

class RegisterController extends AbstractController
{

    public function index()
    {
        return $this->view->render('page/register.twig');
    }

    public function registration()
    {
        var_dump($this->request->getPost());
        die;
        if($this->request->isPost()) {
            $post = $this->request->getPost();
            $this->auth->registration($post);
        }


    }
}

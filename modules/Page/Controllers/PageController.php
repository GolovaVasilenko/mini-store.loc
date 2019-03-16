<?php

namespace Modules\Page\Controllers;


use Core\Controller\AbstractController;

class PageController extends AbstractController
{

    public function index()
    {
        return $this->view->render('page/index.twig', ['name' => 'Fabien']);
    }
}

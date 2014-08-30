<?php

namespace ZPB\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'ZPBAdminBundle:Index:index.html.twig'
        );
    }

}

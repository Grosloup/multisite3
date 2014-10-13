<?php

namespace ZPB\Sites\ZooMobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Default:index.html.twig');
    }
}

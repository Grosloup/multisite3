<?php

namespace ZPB\Sites\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavsController extends Controller
{
    public function topnavAction()
    {
        return $this->render('ZPBSitesZooBundle:Navs:topnav.html.twig');
    }

    public function mainbarAction()
    {
        return $this->render('ZPBSitesZooBundle:Navs:mainbar.html.twig', []);
    }

}

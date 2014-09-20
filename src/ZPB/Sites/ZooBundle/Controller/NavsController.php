<?php

namespace ZPB\Sites\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavsController extends Controller
{


    public function mainbarAction($active_page = "")
    {
        return $this->render('ZPBSitesZooBundle:Navs:mainbar.html.twig', ['active_page'=>$active_page]);
    }

}

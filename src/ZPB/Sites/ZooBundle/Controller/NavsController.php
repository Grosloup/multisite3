<?php

namespace ZPB\Sites\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavsController extends Controller
{
    public function topnavAction()
    {
        $items = $this->get('zpb.zoo.sponsor_basket')->count();
        return $this->render('ZPBSitesZooBundle:Navs:topnav.html.twig', ['basketCount'=>$items]);
    }

    public function mainbarAction()
    {
        return $this->render('ZPBSitesZooBundle:Navs:mainbar.html.twig');
    }

}

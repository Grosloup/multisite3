<?php

namespace ZPB\Sites\ZooBundle\Controller;

use ZPB\AdminBundle\Controller\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:Index:index.html.twig',[]);
    }

    public function sitemapAction()
    {
        return $this->render('ZPBSitesZooBundle:Index:sitemap.html.twig', []);
    }

    public function robotAction()
    {

    }

}

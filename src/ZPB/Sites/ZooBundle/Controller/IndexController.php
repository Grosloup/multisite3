<?php

namespace ZPB\Sites\ZooBundle\Controller;

use ZPB\AdminBundle\Controller\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:Index:index.html.twig',[]);
    }

}

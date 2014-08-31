<?php

namespace ZPB\AdminBundle\Controller;


class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render(
            'ZPBAdminBundle:Index:index.html.twig'
        );
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/11/2014
 * Time: 17:20
 */
  /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Sites\ProBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class GroupController extends BaseController
{

    public function visiteLibreAction()
    {
        return $this->render('ZPBSitesProBundle:Group:visite_libre.html.twig', []);
    }

    public function visiteGuideeAction()
    {
        return $this->render('ZPBSitesProBundle:Group:visite_guidee.html.twig', []);
    }

    public function restoAction()
    {
        return $this->render('ZPBSitesProBundle:Group:resto.html.twig', []);
    }

    public function sejoursAction()
    {
        return $this->render('ZPBSitesProBundle:Group:sejours.html.twig', []);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/09/14
 * Time: 08:24
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

namespace ZPB\Sites\ZooBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class PratiqueController extends BaseController
{
    public function accesTarifsHorairesAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:tarifs.html.twig', []);
    }

    public function animationsAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:animations.html.twig', []);
    }

    public function mapAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:map.html.twig', []);
    }

    public function restoAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:resto.html.twig', []);
    }

    public function servicesAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:services.html.twig', []);
    }


}

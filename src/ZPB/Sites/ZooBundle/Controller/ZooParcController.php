<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/10/2014
 * Time: 11:27
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

class ZooParcController extends BaseController
{
    public function animauxAction()
    {
        return $this->render('ZPBSitesZooBundle:ZooParc:animaux_zoo.html.twig', []);
    }

    public function histoireZooAction()
    {
        return $this->render('ZPBSitesZooBundle:ZooParc:histoire_zoo.html.twig', []);
    }

    public function missionAction()
    {
        return $this->render('ZPBSitesZooBundle:ZooParc:mission.html.twig', []);
    }

    public function devDurableAction()
    {
        return $this->render('ZPBSitesZooBundle:ZooParc:dev_durable.html.twig', []);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/10/2014
 * Time: 12:11
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

class PedagogieController extends BaseController
{
    public function carnetAction()
    {
        return $this->render('ZPBSitesZooBundle:Pedagogie:carnet.html.twig', []);
    }

    public function soigneurAction()
    {
        return $this->render('ZPBSitesZooBundle:Pedagogie:soigneur.html.twig', []);
    }

    public function soigneurJrAction()
    {
        return $this->render('ZPBSitesZooBundle:Pedagogie:soigneur_jr.html.twig', []);
    }

    public function parcoursAction()
    {
        return $this->render('ZPBSitesZooBundle:Pedagogie:parcours.html.twig', []);
    }


} 

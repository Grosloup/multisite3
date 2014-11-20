<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/11/2014
 * Time: 17:34
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

class PratiqueController extends BaseController
{
    public function accesAction()
    {
        return $this->render('ZPBSitesProBundle:Pratique:acces.html.twig', []);
    }

    public function fichesAction()
    {
        return $this->render('ZPBSitesProBundle:Pratique:fiches.html.twig', []);
    }

    public function trucsAction()
    {
        return $this->render('ZPBSitesProBundle:Pratique:trucs.html.twig', []);
    }
} 

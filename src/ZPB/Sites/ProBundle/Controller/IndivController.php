<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/11/2014
 * Time: 17:04
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

class IndivController extends BaseController
{
    public function billetterieAction()
    {
        return $this->render('ZPBSitesProBundle:Indiv:billetterie.html.twig', []);
    }

    public function sejoursAction()
    {
        return $this->render('ZPBSitesProBundle:Indiv:sejours.html.twig', []);
    }

    public function cadeauxAction()
    {
        return $this->render('ZPBSitesProBundle:Indiv:cadeaux.html.twig', []);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 26/09/2014
 * Time: 15:26
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

class ReseauxController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:Reseaux:index.html.twig', []);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 21:12
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

class PresseController extends BaseController
{
    public function communiqueAction()
    {
        return $this->render('ZPBSitesZooBundle:Presse:communiques.html.twig', []);
    }

    public function dossierAction()
    {
        return $this->render('ZPBSitesZooBundle:Presse:dossiers.html.twig', []);
    }
}

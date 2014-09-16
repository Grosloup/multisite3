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
}

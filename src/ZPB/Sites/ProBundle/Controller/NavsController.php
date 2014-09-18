<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 19/09/2014
 * Time: 00:25
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

class NavsController extends BaseController
{
    public function mainbarAction()
    {
        return $this->render('ZPBSitesProBundle:Navs:mainbar.html.twig', []);
    }
}

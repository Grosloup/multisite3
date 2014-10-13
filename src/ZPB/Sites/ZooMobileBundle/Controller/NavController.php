<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/10/2014
 * Time: 00:27
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

namespace ZPB\Sites\ZooMobileBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class NavController extends BaseController
{
    public function topbarAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Nav:topbar.html.twig', []);
    }
}

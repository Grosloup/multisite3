<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 31/08/2014
 * Time: 12:54
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

namespace ZPB\AdminBundle\Controller;



class NavsController extends BaseController
{
    public function sidebarAction($active = '')
    {
        return $this->render('ZPBAdminBundle:Navs:sidebar.html.twig', ['active'=>$active]);
    }

    public function topbarAction()
    {
        return $this->render('ZPBAdminBundle:Navs:topbar.html.twig', []);
    }
}

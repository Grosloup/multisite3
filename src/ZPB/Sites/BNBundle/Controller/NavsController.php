<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 20/09/2014
 * Time: 10:58
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

namespace ZPB\Sites\BNBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function mainbarAction($active_page = "")
    {
        return $this->render('ZPBSitesBNBundle:Navs:mainbar.html.twig', []);
    }

    public function secondaryMainbarAction($active_page = "")
    {
        return $this->render('ZPBSitesBNBundle:Navs:secondaryMainbar.html.twig', ['active_page'=>$active_page]);
    }
}

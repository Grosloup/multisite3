<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 19/09/2014
 * Time: 00:34
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

namespace ZPB\Sites\ScolarBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function mainbarAction($active_page = '')
    {
        return $this->render('ZPBSitesScolarBundle:Navs:mainbar.html.twig', ['active_page'=>$active_page]);
    }

    public function secondaryMainbarAction($active_page = '')
    {
        return $this->render('ZPBSitesScolarBundle:Navs:secondaryMainbar.html.twig', ['active_page'=>$active_page]);
    }
}

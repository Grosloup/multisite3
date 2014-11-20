<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 18/09/2014
 * Time: 14:36
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

namespace ZPB\Sites\CEBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function mainbarAction($active_page = "")
    {
        return $this->render('ZPBSitesCEBundle:Navs:mainbar.html.twig', ['active_page'=>$active_page]);
    }

    public function secondaryMainbarAction($active_page = "")
    {
        return $this->render('ZPBSitesCEBundle:Navs:secondaryMainbar.html.twig', ['active_page'=>$active_page]);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 12:20
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

namespace ZPB\Sites\ProBundle\Controller\English;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function mainbarAction($active_page = '')
    {
        return $this->render('ZPBSitesProBundle:English/Navs:mainbar.html.twig', ['active_page'=>$active_page]);
    }

    public function secondaryMainbarAction($active_page = '')
    {
        return $this->render('ZPBSitesProBundle:English/Navs:secondaryMainbar.html.twig', ['active_page'=>$active_page]);
    }
} 

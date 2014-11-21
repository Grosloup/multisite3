<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 11:23
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

namespace ZPB\Sites\BNBundle\Controller\English;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function mainbarAction()
    {
        return $this->render('ZPBSitesBNBundle:English/Navs:mainbar.html.twig', []);
    }

    public function secondaryMainbarAction()
    {
        return $this->render('ZPBSitesBNBundle:English/Navs:secondaryMainbar.html.twig', []);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 10:39
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

namespace ZPB\Sites\CommonBundle\Controller\English;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function topnavAction($url = null)
    {

        return $this->render('ZPBSitesCommonBundle:English/Navs:topnav.html.twig', ['url'=>$url]);
    }
} 

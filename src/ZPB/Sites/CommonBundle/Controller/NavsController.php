<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 18/09/2014
 * Time: 10:19
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

namespace ZPB\Sites\CommonBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function topnavAction()
    {
        $items = $this->get('zpb.zoo.sponsor_basket')->count();
        return $this->render('ZPBSitesCommonBundle:Navs:topnav.html.twig', ['basketCount'=>$items]);
    }
} 

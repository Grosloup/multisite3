<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 11:03
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

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesBNBundle:English/Index:index.html.twig', []);
    }
} 

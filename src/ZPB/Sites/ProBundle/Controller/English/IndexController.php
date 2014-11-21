<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 12:19
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

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesProBundle:English/Index:index.html.twig', []);
    }
} 

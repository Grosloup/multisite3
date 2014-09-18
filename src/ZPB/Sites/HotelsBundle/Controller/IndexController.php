<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 18/09/2014
 * Time: 07:38
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

namespace ZPB\Sites\HotelsBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesHotelsBundle:Index:index.html.twig', []);
    }
}

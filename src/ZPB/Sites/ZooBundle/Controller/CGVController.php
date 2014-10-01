<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/10/2014
 * Time: 08:58
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

namespace ZPB\Sites\ZooBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class CGVController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:CGV:index.html.twig', []);
    }
} 

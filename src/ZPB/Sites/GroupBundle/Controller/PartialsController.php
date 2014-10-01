<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/10/2014
 * Time: 09:24
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

namespace ZPB\Sites\GroupBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class PartialsController extends BaseController
{
    public function footerAction()
    {
        return $this->render('ZPBSitesGroupBundle:Partials:footer.html.twig', []);
    }
} 

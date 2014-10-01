<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/10/2014
 * Time: 08:37
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

namespace ZPB\Sites\ScolarBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class PartialsController extends BaseController
{
    public function footerAction()
    {
        return $this->render('ZPBSitesScolarBundle:Partials:footer.html.twig', []);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 16:16
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

namespace ZPB\Sites\CEBundle\Controller\English;


use ZPB\AdminBundle\Controller\BaseController;

class PartialsController extends BaseController
{
    public function footerAction()
    {
        return $this->render('ZPBSitesCEBundle:English/Partials:footer.html.twig', []);
    }
} 

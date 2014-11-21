<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 16:18
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

class FAQController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesCEBundle:English/FAQ:index.html.twig', []);
    }
} 

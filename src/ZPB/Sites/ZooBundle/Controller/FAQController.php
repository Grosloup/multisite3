<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/09/2014
 * Time: 10:42
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

class FAQController extends BaseController
{
    public function indexAction()
    {
        $faqs = $this->getRepo('ZPBAdminBundle:FAQ')->findAll();
        return $this->render('ZPBAdminBundle:FAQ:index.html.twig', ['faqs'=>$faqs]);
    }
} 

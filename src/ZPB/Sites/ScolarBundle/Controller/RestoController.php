<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/11/2014
 * Time: 16:22
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

class RestoController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesScolarBundle:Resto:index.html.twig', []);
    }
} 

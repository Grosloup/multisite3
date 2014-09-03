<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/09/14
 * Time: 12:17
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

class PartialsController extends BaseController
{
    public function smallHeaderAction()
    {
        return $this->render('ZPBSitesZooBundle:Partials:small_header.html.twig', []);
    }
} 

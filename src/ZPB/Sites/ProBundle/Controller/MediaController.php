<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/11/2014
 * Time: 17:47
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

namespace ZPB\Sites\ProBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class MediaController extends BaseController
{
    public function toolsAction()
    {
        return $this->render('ZPBSitesProBundle:Media:tools.html.twig', []);
    }

    public function galeriePhotoAction()
    {
        return $this->render('ZPBSitesProBundle:Media:galerie.html.twig', []);
    }
} 

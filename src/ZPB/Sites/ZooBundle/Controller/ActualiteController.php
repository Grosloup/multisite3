<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 16:51
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


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class ActualiteController extends BaseController
{
    public function indexAction($page = 1, Request $request)
    {
        return $this->render('ZPBSitesZooBundle:Actualite:index.html.twig', []);
    }
}

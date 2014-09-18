<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 18/09/2014
 * Time: 06:24
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

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('ZPBSitesZooBundle:Contact:index.html.twig', []);
    }
}

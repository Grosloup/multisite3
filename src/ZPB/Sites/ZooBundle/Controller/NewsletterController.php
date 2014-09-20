<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 20/09/2014
 * Time: 21:12
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

class NewsletterController extends BaseController
{
    public function subscribeAction(Request $request)
    {
        return $this->render('ZPBSitesZooBundle:Newsletter:subscribe.html.twig', []);
    }
}

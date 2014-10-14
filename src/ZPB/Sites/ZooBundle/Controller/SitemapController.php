<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/10/2014
 * Time: 23:59
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

class SitemapController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:Sitemap:index.html.twig', []);
    }
}

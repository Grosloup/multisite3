<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 22/10/2014
 * Time: 15:37
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

namespace ZPB\Sites\ZooMobileBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class ActualiteController extends BaseController
{
    public function indexAction($page = 1, Request $request)
    {
        //TODO
        //
        // paginés
        //
        $pubs = $this->getRepo('ZPBAdminBundle:PublishedPost')->getByTarget('zoo');
        $tags = $this->getRepo('ZPBAdminBundle:PostTag')->getByTarget('zoo');
        $categories  = $this->getRepo('ZPBAdminBundle:PostCategory')->getByTarget('zoo');
        return $this->render('ZPBSitesZooMobileBundle:Actualite:index.html.twig', ['pubs'=>$pubs, 'tags'=>$tags, 'categories'=>$categories]);
    }
}

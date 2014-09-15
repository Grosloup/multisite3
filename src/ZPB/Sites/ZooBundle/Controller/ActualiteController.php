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
        //TODO
        //
        // paginés
        //
        $target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $posts = $this->getRepo('ZPBAdminBundle:Post')->getPublished($target);
        return $this->render('ZPBSitesZooBundle:Actualite:index.html.twig', ['posts'=>$posts, 'img_factory'=>$this->get('zpb.image_factory')]);
    }

    // tri par categorie, publiés, ciblants zoo, paginés
    // tri par mot-clé, publiés, ciblants zoo, paginés
    // tr par date, publiés, ciblants zoo, paginés

    public function singleAction($slug)
    {
        $post = $this->getRepo('ZPBAdminBundle:Post')->findOneBySlug($slug);
        if(!$post){
            throw $this->createAccessDeniedException();
        }

        return $this->render('ZPBSitesZooBundle:Actualite:single.html.twig', ['post'=>$post]);
    }
}

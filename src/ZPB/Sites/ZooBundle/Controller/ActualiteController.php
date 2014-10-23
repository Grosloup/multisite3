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
        $pubs = $this->getRepo('ZPBAdminBundle:PublishedPost')->getByTarget('zoo');
        $tags = $this->getRepo('ZPBAdminBundle:PostTag')->getByTarget('zoo');
        $categories  = $this->getRepo('ZPBAdminBundle:PostCategory')->getByTarget('zoo');
        return $this->render('ZPBSitesZooBundle:Actualite:index.html.twig', ['pubs'=>$pubs, 'tags'=>$tags, 'categories'=>$categories]);
    }



    public function singleAction($slug)
    {
        $pub = $this->getRepo('ZPBAdminBundle:PublishedPost')->getBySlug($slug, 'zoo');

        if(!$pub){
            throw $this->createAccessDeniedException();
        }

        return $this->render('ZPBSitesZooBundle:Actualite:single.html.twig', ['pub'=>$pub]);
    }

    public function nouveautesAction()
    {
        $category = $this->getRepo('ZPBAdminBundle:PostCategory')->findOneBy(['name'=>'Nouveauté','target'=>'zoo']);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $pubs = $this->getRepo('ZPBAdminBundle:PublishedPost')->getByCategoryAndTarget($category->getSlug(), 'zoo');

        return $this->render('ZPBSitesZooBundle:Actualite:post_nouveaute.html.twig', ['pubs'=>$pubs]);
    }

    public function carnetRoseAction()
    {
        //return $this->forward('ZPBSitesZooBundle:Actualite:postsByCategory', ['slug'=>'carnet-rose']);
    }

    public function postsByCategoryAction($slug)
    {
        $category = $this->getRepo('ZPBAdminBundle:PostCategory')->findOneBySlug($slug);
        if(!$category){
            throw $this->createNotFoundException();
        }

        $pubs = $this->getRepo('ZPBAdminBundle:PublishedPost')->getByCategoryAndTarget($slug, 'zoo');

        return $this->render('ZPBSitesZooBundle:Actualite:post_by_category.html.twig', ['pubs'=>$pubs, 'category'=>$category]);
    }

    public function postsByTagAction($slug)
    {
        $tag = $this->getRepo('ZPBAdminBundle:PostTag')->findOneBySlug($slug);
        if(!$tag){
            throw $this->createNotFoundException();
        }

        $pubs = $this->getRepo('ZPBAdminBundle:PublishedPost')->getByTagAndTarget($slug, 'zoo');

        return $this->render('ZPBSitesZooBundle:Actualite:posts_by_tag.html.twig', ['pubs'=>$pubs, 'tag'=>$tag]);
    }

    public function listCategoriesAction()
    {
        /*$target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $categories = $this->getRepo('ZPBAdminBundle:Post')->getCategoriesByTarget($target);

        return $this->render('ZPBSitesZooBundle:Actualite:categories.html.twig', ['categories'=>$categories]);*/
    }

    public function listTagsAction()
    {
        /*$target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $tags = $this->getRepo('ZPBAdminBundle:Post')->getTagsByTarget($target);

        return $this->render('ZPBSitesZooBundle:Actualite:tags.html.twig', ['tags'=>$tags]);*/
    }
}

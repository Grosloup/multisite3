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

    public function nouveautesAction()
    {
        return $this->forward('ZPBSitesZooBundle:Actualite:postsByCategory', ['slug'=>'nouveaute']);
    }

    public function carnetRoseAction()
    {
        return $this->forward('ZPBSitesZooBundle:Actualite:postsByCategory', ['slug'=>'carnet-rose']);
    }

    public function postsByCategoryAction($slug)
    {
        $category = $this->getRepo('ZPBAdminBundle:PostCategory')->findOneBySlug($slug);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $posts = $this->getRepo('ZPBAdminBundle:Post')->getPublishedByCategoryAndTarget($category, $target);

        return $this->render('ZPBSitesZooBundle:Actualite:post_by_category.html.twig', ['posts'=>$posts, 'category'=>$category]);
    }

    public function postsByTagAction($slug)
    {
        $tag = $this->getRepo('ZPBAdminBundle:PostTag')->findOneBySlug($slug);
        if(!$tag){
            throw $this->createNotFoundException();
        }
        $target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $posts = $this->getRepo('ZPBAdminBundle:Post')->getPublishedByTagAndTarget($tag, $target);

        return $this->render('ZPBSitesZooBundle:Actualite:posts_by_tag.html.twig', ['posts'=>$posts, 'tag'=>$tag]);
    }

    public function listCategoriesAction()
    {
        $target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $categories = $this->getRepo('ZPBAdminBundle:Post')->getCategoriesByTarget($target);

        return $this->render('ZPBSitesZooBundle:Actualite:categories.html.twig', ['categories'=>$categories]);
    }

    public function listTagsAction()
    {
        $target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
        $tags = $this->getRepo('ZPBAdminBundle:Post')->getTagsByTarget($target);

        return $this->render('ZPBSitesZooBundle:Actualite:tags.html.twig', ['tags'=>$tags]);
    }
}

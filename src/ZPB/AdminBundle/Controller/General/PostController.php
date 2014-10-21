<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/10/2014
 * Time: 10:36
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

namespace ZPB\AdminBundle\Controller\General;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Post;
use ZPB\AdminBundle\Entity\PostCategory;
use ZPB\AdminBundle\Entity\PostTag;
use ZPB\AdminBundle\Form\type\PostType;

class PostController extends BaseController
{
    public function listAction()
    {
        return $this->render('ZPBAdminBundle:General/Post:list.html.twig', []);
    }

    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);
        if($form->isValid()){

            $this->getManager()->persist($post);
            $this->getManager()->flush();


            if($form->get('save')->isClicked()){
                return $this->redirect($this->generateUrl('zpb_admin_actualites_list'));
            }

            if($form->get('publish')->isClicked()){
                return $this->redirect($this->generateUrl('zpb_admin_actualites_publier'));
            }
        }
        return $this->render('ZPBAdminBundle:General/Post:create.html.twig', ['form'=>$form->createView()]);
    }

    public function publishAction($id)
    {
        //$post = $this->getRepo('ZPBAdminBundle:Post')->find($id);
        //if(!$post){
            //throw $this->createNotFoundException();
        //}

        return $this->render('ZPBAdminBundle:General/Post:publish.html.twig',
            [
                'targets'=>$this->getTargets(),
                'categories'=>$this->getCategoriesByTarget(),
                'tags'=>$this->getTagsByTarget()
            ]
        );
    }

    public function updateAction($id, Request $request)
    {
        return $this->render('ZPBAdminBundle:General/Post:update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {
    }

    public function listPublishedAction()
    {
        return $this->render('ZPBAdminBundle:General/Post:list_published.html.twig', []);
    }

    public function listArchivedAction()
    {
        return $this->render('ZPBAdminBundle:General/Post:list_archived.html.twig', []);
    }

    private function getTargets()
    {
        return $this->container->getParameter('zpb.post_targets');
    }

    private function getCategoriesByTarget()
    {
        $targets = $this->getTargets();
        $result = [];
        foreach($targets as $k=>$v){
            $result[$k] = $this->getRepo('ZPBAdminBundle:PostCategory')->findBy(['target'=>$k], ['name'=>'ASC']);
        }
        return $result;
    }

    private function getTagsByTarget()
    {
        $targets = $this->getTargets();
        $result = [];
        foreach($targets as $k=>$v){
            $result[$k] = $this->getRepo('ZPBAdminBundle:PostTag')->findBy(['target'=>$k], ['name'=>'ASC']);
        }
        return $result;
    }

    public function apiCategoryCreateAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $categoryDatas = json_decode($request->getContent(), true);
        $category = new PostCategory();
        $category->setName($categoryDatas['name'])->setTarget($categoryDatas['target']);
        $this->getManager()->persist($category);
        $this->getManager()->flush();


        return new JsonResponse(["error"=>false, "category"=>["name"=>$category->getName(),"id"=>$category->getId(),"slug"=>$category->getSlug(),"target"=>$category->getTarget()]]);
    }

    public function apiTagCreateAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $tagDatas = json_decode($request->getContent(), true);

        $tag = new PostTag();

        $tag->setName($tagDatas['name'])->setTarget($tagDatas['target']);
        $this->getManager()->persist($tag);
        $this->getManager()->flush();


        return new JsonResponse(["error"=>false, "tag"=>["name"=>$tag->getName(),"id"=>$tag->getId(),"slug"=>$tag->getSlug(),"target"=>$tag->getTarget()]]);
    }
}

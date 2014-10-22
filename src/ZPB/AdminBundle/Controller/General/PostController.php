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


use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Post;
use ZPB\AdminBundle\Entity\PostCategory;
use ZPB\AdminBundle\Entity\PostTag;
use ZPB\AdminBundle\Entity\PublishedPost;
use ZPB\AdminBundle\Form\type\PostType;

class PostController extends BaseController
{
    public function listAction()
    {
        $posts = $this->getRepo('ZPBAdminBundle:Post')->getDrafts();
        return $this->render('ZPBAdminBundle:General/Post:list.html.twig', ['posts'=>$posts]);
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
        return $this->render('ZPBAdminBundle:General/Post:publish.html.twig',
            [
                'id'=>$id,
                'targets'=>$this->getTargets(),
                'categories'=>$this->getCategoriesByTarget(),
                'tags'=>$this->getTagsByTarget()
            ]
        );
    }

    public function updateAction($id, Request $request)
    {
        $post = $this->getRepo('ZPBAdminBundle:Post')->find($id);
        if(!$post){
            throw $this->createNotFoundException();
        }

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
        return $this->render('ZPBAdminBundle:General/Post:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
    }

    public function listPublishedAction()
    {
        $posts = $this->getRepo('ZPBAdminBundle:Post')->getPublished();
        return $this->render('ZPBAdminBundle:General/Post:list_published.html.twig', ['posts'=>$posts]);
    }

    public function listArchivedAction()
    {
        $posts = $this->getRepo('ZPBAdminBundle:Post')->getArchived();
        return $this->render('ZPBAdminBundle:General/Post:list_archived.html.twig', ['posts'=>$posts]);
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

    public function postImageUploadAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name', false);
        $fileType = $request->headers->get('X-File-Type', false);
        $response = ['error'=>false,'msg'=>'', 'imgId'=>''];

        if(!$filename || !$fileType){
            $response = ['error'=>true,'msg'=>'Données manquantes', 'imgId'=>''];
        } elseif(!in_array($fileType, ['image/jpeg', 'image/gif', 'image/png'])){
            $response = ['error'=>true,'msg'=>'Données érronées', 'imgId'=>''];
        } else {
            $basePath =
                $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir']
                . $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir']
            ;
            if($fs->exists($basePath)){
                $fs->mkdir($basePath);
            }
            $path = $basePath . $filename;
            if($fs->exists($path)){
                $filenameNoExtension = pathinfo($filename, PATHINFO_FILENAME);
                $old = $this->getRepo('ZPBAdminBundle:MediaImage')->findOneByFilename($filenameNoExtension);
                if($old){
                    $this->getManager()->remove($old);
                    $this->getManager()->flush();
                }
            }
            file_put_contents($path, $request->getContent());
            $file = new File($path);
            $image = $this->get('zpb.image_factory')->createFromFile($file);
            $this->get('zpb.image_resizer')->makeThumbnails($image);
            try{
                $this->getManager()->persist($image);
                $this->getManager()->flush();
                $response = ['error'=>false,'msg'=>'Transfert réussi', 'imageId'=>$image->getId()];
            } catch(\Exception $e){
                $response = ['error'=>true,'msg'=>$e->getMessage(), 'imageId'=>''];
            }
        }

        return new JsonResponse($response);
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

    public function apiPublishPostAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $postDatas = json_decode($request->getContent(), true);

        /** @var \ZPB\AdminBundle\Entity\Post $post */
        $post = $this->getRepo('ZPBAdminBundle:Post')->find($postDatas["postId"]);

        $publications = $postDatas["editOn"];
        $response = ["error"=>false, "messages"=>[], "post"=>$post];
        $categories = [];

        foreach($publications as $key=>$value){
            if($value){
                if($postDatas[$key]['category'] != null && is_int($postDatas[$key]['category'])){
                    $cat = $this->getRepo('ZPBAdminBundle:PostCategory')->find($postDatas[$key]['category']);
                    if($cat){
                        $categories[$key] = $cat;
                    } else {
                        $response['error'] = true;
                        $response['messages'][] = 'Une catégorie est introuvable';
                    }
                } else {
                    $response['error'] = true;
                    $response['messages'][] = 'La publication de l\'article ' . $post->getId() . ' sur ' . $this->getTargets()[$key] . ' est impossible, pas de catégorie déclarée.';
                }
            }
        }

        if($response['error'] === false){
            foreach($publications as $key=>$value){
                if($value){
                    $pub = new PublishedPost();
                    $pub->setPost($post);
                    $pub->setTarget($key);
                    $cat = $categories[$key];
                    $pub->setCategory($cat);
                    $pub->setPublishedAt(new \DateTime());
                    $tagIds = $postDatas[$key]['tags'];
                    foreach($tagIds as $tagId){
                        $tag = $this->getRepo('ZPBAdminBundle:PostTag')->find($tagId);
                        if($tag){
                            $pub->addTag($tag);
                        }
                    }
                }
            }
            $post->setIsPublished(true);
            $response['messages'][] = 'Article publié';
        }

        return new JsonResponse($response);
    }
}

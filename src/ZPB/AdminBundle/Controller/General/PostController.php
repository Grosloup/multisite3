<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 31/08/2014
 * Time: 13:08
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
use ZPB\AdminBundle\Form\Type\PostType;

class PostController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:Post')->findBy(['isPublished'=>true], ['createdAt'=>'DESC']);
        return $this->render('ZPBAdminBundle:General:post/list.html.twig', ['posts'=>$entities]);
    }

    public function listDraftAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:Post')->findBy(['isDraft'=>true], ['createdAt'=>'DESC']);
        return $this->render('ZPBAdminBundle:General:post/list_draft.html.twig', ['posts'=>$entities]);
    }

    public function listArchivedAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:Post')->findBy(['isArchived'=>true], ['createdAt'=>'DESC']);
        return $this->render('ZPBAdminBundle:General:post/list_archived.html.twig', ['posts'=>$entities]);
    }

    public function listDroppedAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:Post')->findBy(['isDropped'=>true], ['createdAt'=>'DESC']);
        return $this->render('ZPBAdminBundle:General:post/list_dropped.html.twig', ['posts'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            foreach($entity->getTags() as $tag){
                /** @var \ZPB\AdminBundle\Entity\PostTag $tmp */
                /** @var \ZPB\AdminBundle\Entity\PostTag $tag */
                $tmp = $this->getRepo('ZPBAdminBundle:PostTag')->findOneByName($tag->getName());
                if($tmp){
                    $entity->removeTag($tag);
                    $entity->addTag($tmp);
                    $tmp->addPost($entity);
                    $this->getManager()->persist($tmp);
                } else {
                    $this->getManager()->persist($tag);
                }
            }
            if($form->get('save_publish')->isClicked()){
                $this->getRepo('ZPBAdminBundle:Post')->publish($entity);
            }
            $illustration = $this->getRepo('ZPBAdminBundle:PostImg')->findOneByPostLongId($entity->getLongId());
            if($illustration != null){
                $entity->setIllustration($illustration);
            }
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Nouvel article d\'actualité bien créé.');
            return $this->redirect($this->generateUrl('zpb_admin_posts_list'));
        }
        return $this->render('ZPBAdminBundle:General:post/create.html.twig', ['form'=>$form->createView()]);
    }

    public function uploadImageAction(Request $request)
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

    public function updateAction($id, Request $request)
    {
        //TODO
        return $this->render('ZPBAdminBundle:General:post/update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {
        //TODO

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 14:26
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


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\PostTag;
use ZPB\AdminBundle\Form\Type\PostTagType;

class PostTagController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:PostTag')->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:General/post_tag:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new PostTag();
        $form = $this->createForm(new PostTagType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();

            $this->setSuccess('Nouveau mot-clé bien enregistré');
            return $this->redirect($this->generateUrl('zpb_admin_posts_tags_list'));
        }
        return $this->render('ZPBAdminBundle:General/post_tag:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:PostTag')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PostTagType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Mot-clé bien modifié');
            return $this->redirect($this->generateUrl('zpb_admin_posts_tags_list'));
        }
        return $this->render('ZPBAdminBundle:General/post_tag:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_post_tag')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:PostTag')->find($id)){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        $this->setSuccess('Mot-clé '.$entity->getName().' bien supprimé');
        return $this->redirect($this->generateUrl('zpb_admin_posts_tags_list'));
    }

}

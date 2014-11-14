<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 09:44
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
use ZPB\AdminBundle\Form\Type\InstitutionChoiceType;
use ZPB\AdminBundle\Form\Type\PhotoType;
use ZPB\AdminBundle\Form\Type\PhotoUpdateType;

class PhotoController extends BaseController
{

    public function chooseListAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();
        return $this->render('ZPBAdminBundle:General/Photo:choose_list.html.twig', ['institutions'=>$institutions]);
    }

    public function listAction($id)
    {
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($id);
        if(!$category){
            throw $this->createNotFoundException();
        }

        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['category'=>$category], ['position'=>'ASC']);
        return $this->render('ZPBAdminBundle:General/Photo:list.html.twig', ['photos'=>$photos, 'category'=>$category]);
    }

    public function chooseInstitutionAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();
        return $this->render('ZPBAdminBundle:General/Photo:choose_institution.html.twig', ['institutions'=>$institutions]);
    }

    public function createAction($institution_slug, Request $request)
    {
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug($institution_slug);
        if(!$institution){
            throw $this->createNotFoundException();
        }
        $photo = $this->get('zpb.photo_factory')->create($institution->getId());
        $form = $this->createForm(new PhotoType(), $photo, ['em'=>$this->getManager(), 'slug'=>$institution_slug, 'action'=>$this->generateUrl('zpb_admin_photos_hd_create', ['institution_slug'=>$institution_slug])]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->get('zpb.photo_factory')->createDirs($this->get('filesystem'));
            $photo->upload();
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
            $this->get('zpb.photo_resizer')->makeThumbnails($photo);
            return $this->redirect($this->generateUrl('zpb_admin_photos_list'));
        }
        return $this->render('ZPBAdminBundle:General:photo/create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        /** @var \ZPB\AdminBundle\Entity\Photo $photo */
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            $this->createNotFoundException();
        }
        $form = $this->createForm(new PhotoUpdateType(), $photo, ['em'=>$this->getManager(), 'slug'=>$photo->getCategory()->getInstitution()->getSlug()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
            $this->setSuccess('Photo bien modifiée.');
            return $this->redirect($this->generateUrl('zpb_admin_photos_list'));
        }
        return $this->render('ZPBAdminBundle:General:photo/update.html.twig', ['form'=>$form->createView(), 'photo_factory'=>$this->get('zpb.photo_factory')]);
    }

    public function positionUpAction($id)
    {
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            throw $this->createNotFoundException();
        }
        $position = $photo->getPosition();
        if($position > 0 ){
            $photo->setPosition($position - 1);
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
        }
        return $this->forward('ZPBAdminBundle:General/Photo:getListByCategory', ['categoryId'=>$photo->getCategory()->getId()]);
    }

    public function positionDownAction($id)
    {
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            throw $this->createNotFoundException();
        }
        $position = $photo->getPosition();
        $last = $this->getRepo('ZPBAdminBundle:Photo')->getLastPositionInCategory($photo->getCategory()->getId());

        if($position < $last ){
            $photo->setPosition($position + 1);
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
        }
        return $this->forward('ZPBAdminBundle:General/Photo:getListByCategory', ['categoryId'=>$photo->getCategory()->getId()]);

    }

    public function getListByCategoryAction($categoryId)
    {
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($categoryId);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['category'=>$category], ['position'=>'ASC']);
        $stats = [];
        foreach($photos as $photo){
            $stats[$photo->getId()] = $this->getRepo('ZPBAdminBundle:PhotoStat')->getDownloadsForOne($photo->getId());
        }

        return $this->render('ZPBAdminBundle:General/photo:list_by_category.html.twig', ['photo_factory'=>$this->get('zpb.photo_factory'),'photos'=>$photos, 'category'=>$category, 'stats'=>$stats]);
    }

    public function positionChangeXhrAction(Request $request)
    {
        if(!$request->isMethod("post") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $id = $request->request->get('id', false);
        if($id !== false){
            $id = intval($id);
        }
        $position = $request->request->get('position', false);
        if($position !== false){
            $position = intval($position);
        }
        $response = ['error'=>'ok', 'oldPosition'=>null, 'id'=>null, 'newPosition'=>null];
        if($id === false || $position === false){
            $response['error'] = 'Données manquantes';
            return new JsonResponse($response);
        }

        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            $response['error'] = 'Photo introuvable';
            return new JsonResponse($response);
        }
        $oldPos = $photo->getPosition();
        $photo->setPosition($position);
        $this->getManager()->persist($photo);
        $this->getManager()->flush();
        $response['oldPosition'] = $oldPos;
        $response['newPosition'] = $position;
        $response['id'] = $id;
        return new JsonResponse($response);

    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token', false), 'delete_photo')){
            throw $this->createAccessDeniedException();
        }
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($photo);
        $this->getManager()->flush();
        $this->setSuccess('Photo bien supprimée');
        return $this->redirect($this->generateUrl('zpb_admin_photos_list'));
    }
}

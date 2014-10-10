<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 06/10/2014
 * Time: 10:25
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
use ZPB\AdminBundle\Form\Type\PhotoHdType;

class PhotoHdController extends BaseController
{
    public function chooseListAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();

        return $this->render('ZPBAdminBundle:General/PhotoHd:choose_list.html.twig', ['institutions'=>$institutions]);
    }

    public function listAction($id)
    {
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($id);
        if(!$category){
            throw $this->createNotFoundException();
        }

        $photos = $this->getRepo('ZPBAdminBundle:PhotoHd')->findBy(['category'=>$category], ['position'=>'ASC']);
        return $this->render('ZPBAdminBundle:General/PhotoHd:list.html.twig', ['photos'=>$photos, 'category'=>$category]);
    }

    public function chooseInstitutionAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();
        return $this->render('ZPBAdminBundle:General/PhotoHd:choose_institution.html.twig', ['institutions'=>$institutions]);
    }

    public function createAction($institution_slug, Request $request)
    {
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug($institution_slug);
        if(!$institution){
            throw $this->createNotFoundException();
        }
        $photo = $this->get('zpb.photo_hd_factory')->create($institution->getId());
        $form = $this->createForm(new PhotoHdType(), $photo, ['em'=>$this->getManager(), 'slug'=>$institution_slug, 'action'=>$this->generateUrl('zpb_admin_photos_hd_create', ['institution_slug'=>$institution_slug])]);


        $form->handleRequest($request);
        if($form->isValid()){
            $this->get('zpb.photo_hd_factory')->createDirs($this->get('filesystem'));
            $photo->upload();
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
            $this->get('zpb.photo_hd_resizer')->makeThumbnails($photo);
            return $this->redirect($this->generateUrl('zpb_admin_photos_hd_choose_list'));
        }
        return $this->render('ZPBAdminBundle:General/PhotoHd:create.html.twig', ['form'=>$form->createView()]);
    }

    public function positionChangeXhrAction(Request $request)
    {
        if(!$request->isMethod("post") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $id = intval($request->request->get('id', false));
        $position = intval($request->request->get('position', false));
        $response = ['error'=>'ok', 'oldPosition'=>null, 'id'=>null, 'newPosition'=>null];
        if($id === false || $position === false){
            $response['error'] = 'Données manquantes';
            return new JsonResponse($response);
        }

        $photo = $this->getRepo('ZPBAdminBundle:PhotoHd')->find($id);
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

    public function updateAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {
        //delete_photo_hd
    }

    public function listUsersAction()
    {

    }

    public function createUserAction(Request $request)
    {

    }

    public function updateUserAction($id, Request $request)
    {

    }

    public function deleteUserAction($id, Request $request)
    {

    }
} 

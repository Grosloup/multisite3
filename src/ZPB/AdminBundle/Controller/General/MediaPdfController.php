<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 22:38
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
use ZPB\AdminBundle\Entity\MediaPdf;
use ZPB\AdminBundle\Form\Type\MediaPdfType;
use ZPB\AdminBundle\Form\Type\MediaPdfUpdateType;

class MediaPdfController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:MediaPdf')->findAll(); //->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:General/MediaPdf:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = $this->get('zpb.pdf_factory')->create();
        $form = $this->createForm(new MediaPdfType(), $entity, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $entity->upload();
            $this->getManager()->persist($entity);
            $this->getManager()->flush();

            $this->setSuccess('Nouveau pdf bien enregistré');
            return $this->redirect($this->generateUrl('zpb_admin_media_pdf_list'));
        }
        return $this->render('ZPBAdminBundle:General/MediaPdf:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:MediaPdf')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new MediaPdfUpdateType(), $entity, ['em'=>$this->getManager()]); //TODO update type
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Pdf bien modifié');
            return $this->redirect($this->generateUrl('zpb_admin_media_pdf_list'));
        }
        return $this->render('ZPBAdminBundle:General/MediaPdf:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_pdf')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:MediaPdf')->find($id)){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        $this->setSuccess('Pdf bien supprimé');
        return $this->redirect($this->generateUrl('zpb_admin_media_pdf_list'));
    }

}

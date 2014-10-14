<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/10/2014
 * Time: 09:10
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
use ZPB\AdminBundle\Entity\PressKit;
use ZPB\AdminBundle\Form\Type\PressKitType;

class PressKitController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:PressKit')->findAll();
        return $this->render('ZPBAdminBundle:General/PressKit:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new PressKit();
        $form = $this->createForm(new PressKitType(), $entity, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Nouveau dossier bien enregistré');
            return $this->redirect($this->generateUrl('zpb_admin_general_press_kit_list'));
        }
        return $this->render('ZPBAdminBundle:General/PressKit:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:PressKit')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PressKitType(), $entity, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Nouveau dossier bien modifié');
            return $this->redirect($this->generateUrl('zpb_admin_general_press_kit_list'));
        }
        return $this->render('ZPBAdminBundle:General/PressKit:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id,Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_press_kit')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:PressKit')->find($id)){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        $this->setSuccess('Dossier bien supprimé');
        return $this->redirect($this->generateUrl('zpb_admin_general_press_kit_list'));
    }

    public function uploadPdfAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name');
        $fileType = $request->headers->get('X-File-Type', false);
        $response = ['error'=>false,'msg'=>'', 'pdfId'=>''];
        if(!$filename || !$fileType){
            $response = ['error'=>true,'msg'=>'Données manquantes', 'pdfId'=>''];
        } elseif(!in_array($fileType, ['application/pdf'])){
            $response = ['error'=>true,'msg'=>'Données érronées', 'imgId'=>''];
        } else {
            $basePath = $this->container->getParameter('zpb.medias.options')['zpb.pdf.root_dir'] . $this->container->getParameter('zpb.medias.options')['zpb.pdf.web_dir'];
            if(!$fs->exists($basePath)){
                $fs->mkdir($basePath);
            }
            $lang = $request->headers->get('X-File-Lang');
            if($lang && $lang != 'fr'){
                $lang .= '_';
            } else {
                $lang = '';
            }
            $path = $basePath . $lang . $filename;
            if($fs->exists($path)){

                $filenameNoExtension = preg_replace('/\.pdf$/i','',$filename);
                $old = $this->getRepo('ZPBAdminBundle:MediaPdf')->findOneByFilename($filenameNoExtension);
                if($old){
                    $this->getManager()->remove($old);
                    $this->getManager()->flush();
                }
            }
            file_put_contents($path, $request->getContent());
            $file = new File($path);
            $pdf = $this->get('zpb.pdf_factory')->createFromFile($file);
            if(null != $institutionId = $request->headers->get('X-File-Institution', null)){
                $institution = $this->getRepo('ZPBAdminBundle:Institution')->find($institutionId);
                if($institution){
                    $pdf->setInstitution($institution);
                }
            }
            try{
                $this->getManager()->persist($pdf);
                $this->getManager()->flush();
                $response = ['error'=>false,'msg'=>'Transfert réussi', 'pdfId'=>$pdf->getId()];
            } catch(\Exception $e){
                $response = ['error'=>true,'msg'=>$e->getMessage(), 'pdfId'=>''];
            }
        }


        return new JsonResponse($response);
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
}

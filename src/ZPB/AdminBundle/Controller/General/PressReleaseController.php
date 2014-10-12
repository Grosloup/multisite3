<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 21:41
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
use ZPB\AdminBundle\Entity\PressRelease;
use ZPB\AdminBundle\Form\Type\PressReleaseType;

class PressReleaseController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:PressRelease')->findAll(); //->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:General/PressRelease:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new PressRelease();
        $form = $this->createForm(new PressReleaseType(), $entity, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){

            $this->getManager()->persist($entity);
            $this->getManager()->flush();

            $this->setSuccess('Nouveau communiqué bien enregistré');
            return $this->redirect($this->generateUrl('zpb_admin_general_press_release_list'));
        }
        return $this->render('ZPBAdminBundle:General/PressRelease:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:PressRelease')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PressReleaseType(), $entity, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $imageName = $form->get('imageName')->getData();
            if($imageName){
                $image = $this->getRepo('ZPBAdminBundle:MediaImage')->findOneByFilename($imageName);
                if($image){
                    $entity->setImage($image);
                }
            }
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Communiqué bien modifié');
            return $this->redirect($this->generateUrl('zpb_admin_general_press_release_list'));
        }
        return $this->render('ZPBAdminBundle:General/PressRelease:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_press_release')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:PressRelease')->find($id)){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        $this->setSuccess('Communiqué bien supprimé');
        return $this->redirect($this->generateUrl('zpb_admin_general_press_release_list'));
    }

    public function uploadPdfAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name');
        $response = ['error'=>false,'msg'=>'', 'pdfId'=>''];
        if(!$filename){
            $response = ['error'=>true,'msg'=>'Données manquantes', 'pdfId'=>''];
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
                $this->getManager()->remove($old);
                $this->getManager()->flush();
            }
            file_put_contents($path, $request->getContent());
            $file = new File($path);
            if(!in_array($file->getMimeType(), ['application/pdf'])){
                $fs->remove($path);
                $file = null;
                $response['error'] = true;
                $response['msg'] = 'Le fichier n\'est pas d\'un format acceptable.';
            } else {

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
        $response = ['error'=>false,'msg'=>'', 'imgId'=>''];

        if(!$filename){
            $response = ['error'=>true,'msg'=>'Données manquantes', 'imgId'=>''];
        }
        // image_factory createDir, createFromFile
        //TODO image use case

        return new JsonResponse($response);
    }

}

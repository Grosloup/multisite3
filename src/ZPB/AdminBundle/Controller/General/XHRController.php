<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 07/09/2014
 * Time: 08:46
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
use ZPB\AdminBundle\Entity\PostImg;

class XHRController extends BaseController
{
    public function imgUploadAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false,'msg'=>'', 'html'=>'', 'imgId'=>''];
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name');

        $basePath = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] . $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir'];
        if(!$fs->exists($basePath)){
            $fs->mkdir($basePath);
        }
        $path = $basePath . '/' . $filename;
        if($fs->exists($path)){
            $response['error'] = true;
            $response['msg'] = 'Un fichier du même nom existe déjà.';
        } else {
            file_put_contents($path, $request->getContent());

            $file = new File($path);
            if(!in_array($file->getMimeType(), ['image/jpeg', 'image/gif', 'image/png'])){
                $fs->remove($path);
                $file = null;
                $response['error'] = true;
                $response['msg'] = 'Le fichier n\'est pas d\'un format acceptable.';
            } else {
                $baseWebPath = $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir'];
                $webPath = '/' . $baseWebPath . $filename;

                $image = $this->get('zpb.image_factory')->createFromFile($file);
                try{
                    $this->getManager()->persist($image);
                    $this->getManager()->flush();
                    $this->get('zpb.photo_resizer')->makeThumbnails($image);
                    if($request->headers->get('X-File-Id', false)){
                        $postToImg = new PostImg();
                        $postToImg->setImg($image);
                        $postToImg->setPostLongId($request->headers->get('X-File-Id'));
                        $this->getManager()->persist($postToImg);
                        $this->getManager()->flush();
                        $response['html'] = "<img src='" . $webPath . "' width='100%' data-id='" . $image->getId() . "'/>";
                        $response['msg'] = 'Transfert réussi.';
                        $response['imgId'] = $image->getId();
                    }
                } catch (\Exception $e){
                    $response = ['error'=>true,'msg'=>$e->getMessage(), 'html'=>''];
                }
            }
        }

        return new JsonResponse($response);
    }

    public function imgDeleteAction($id, Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false,'msg'=>'', 'html'=>''];
        $image = $this->getRepo('ZPBAdminBundle:MediaImage')->find($id);
        if(!$image){
            $response = ['error'=>true,'msg'=>'Image introuvable', 'html'=>''];
        } else {
            $postToImg = $this->getRepo('ZPBAdminBundle:PostImg')->findAllByImg($image);
            if($postToImg){
                foreach($postToImg as $line){
                    $this->getManager()->remove($line);
                }

            }
            $this->getManager()->remove($image);
            $this->getManager()->flush();
            $response['msg'] = 'Image supprimée.';
        }
        return new JsonResponse($response);
    }

    public function imgRestoUploadAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false,'msg'=>'', 'html'=>'', 'imgId'=>''];
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name');

        $basePath = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] . $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir'];
        if(!$fs->exists($basePath)){
            $fs->mkdir($basePath);
        }
        $path = $basePath . '/' . $filename;
        if($fs->exists($path)){
            $response['error'] = true;
            $response['msg'] = 'Un fichier du même nom existe déjà.';
        } else {
            file_put_contents($path, $request->getContent());

            $file = new File($path);
            if(!in_array($file->getMimeType(), ['image/jpeg', 'image/gif', 'image/png'])){
                $fs->remove($path);
                $file = null;
                $response['error'] = true;
                $response['msg'] = 'Le fichier n\'est pas d\'un format acceptable.';
            } else {
                $baseWebPath = $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir'];
                $webPath = '/' . $baseWebPath . $filename;

                $image = $this->get('zpb.image_factory')->createFromFile($file);
                try{
                    $this->getManager()->persist($image);
                    $this->getManager()->flush();
                    //$this->get('zpb.photo_resizer')->makeThumbnails($image);
                    if($request->headers->get('X-File-Id', false)){

                        $response['html'] = "<img src='" . $webPath . "' width='100%' data-id='" . $image->getId() . "'/>";
                        $response['msg'] = 'Transfert réussi.';
                        $response['imgId'] = $image->getId();
                    }
                } catch (\Exception $e){
                    $response = ['error'=>true,'msg'=>$e->getMessage(), 'html'=>''];
                }
            }
        }

        return new JsonResponse($response);
    }

    public function imgRestoDeleteAction($id, Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false,'msg'=>'', 'html'=>''];
        $image = $this->getRepo('ZPBAdminBundle:MediaImage')->find($id);
        if(!$image){
            $response = ['error'=>true,'msg'=>'Image introuvable', 'html'=>''];
        } else {

            $this->getManager()->remove($image);
            $this->getManager()->flush();
            $response['msg'] = 'Image supprimée.';
        }
        return new JsonResponse($response);
    }

    public function getImgIdAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $filename = $request->request->get('filename');
        $response = ['error'=>false,'msg'=>'', 'imgId'=>''];
        if(!$filename){
            $response = ['error'=>true,'msg'=>'Données manquantes', 'imgId'=>''];
        } else {
            $image = $this->getRepo('ZPBAdminBundle:MediaImage')->findOneByFilename($filename);
            if(!$image){
                $response = ['error'=>true,'msg'=>'Image introuvable', 'imgId'=>''];
            } else {
                $response = ['error'=>false,'msg'=>'', 'imgId'=>$image->getId()];
            }
        }

        return new JsonResponse($response);

    }

    public function uploadPdfAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name');
        $response = ['error'=>false,'msg'=>'', 'pdfFilename'=>''];
        if(!$filename){
            $response = ['error'=>true,'msg'=>'Données manquantes', 'pdfFilename'=>''];
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
                $response['error'] = true;
                $response['msg'] = 'Un fichier du même nom existe déjà.';
            } else {
                file_put_contents($path, $request->getContent());
                $file = new File($path);
                if(!in_array($file->getMimeType(), ['application/pdf'])){
                    $fs->remove($path);
                    $file = null;
                    $response['error'] = true;
                    $response['msg'] = 'Le fichier n\'est pas d\'un format acceptable.';
                } else {

                    $pdf = $this->get('zpb.pdf_factory')->createFromFile($file);
                    if(null != $institutionSlug = $request->headers->get('X-File-Institution', null)){
                        $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug($institutionSlug);
                        if($institution){
                            $pdf->setInstitution($institution);
                        }

                    }
                    try{
                        $this->getManager()->persist($pdf);
                        $this->getManager()->flush();
                        $response = ['error'=>false,'msg'=>'Transfert réussi', 'pdfFilename'=>$pdf->getFilename()];
                    } catch(\Exception $e){
                        $response = ['error'=>true,'msg'=>$e->getMessage(), 'pdfFilename'=>''];
                    }
                }
            }
        }


        return new JsonResponse($response);
    }

    public function updateCommuniquePdfAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $fs = $this->get('filesystem');
        $response = ['error'=>false,'msg'=>'', 'pdfFilename'=>''];

        $filename = $request->headers->get('X-File-Name');

        if(!$filename){
            $response = ['error'=>true,'msg'=>'Données insuffisantes', 'pdfFilename'=>''];
        } else {
            $basePath = $this->container->getParameter('zpb.medias.options')['zpb.pdf.root_dir'] . $this->container->getParameter('zpb.medias.options')['zpb.pdf.web_dir'];
            if(!$fs->exists($basePath)){
                $fs->mkdir($basePath);
            }
            $tmpPathDir = $basePath . 'tmp/';
            if(!$fs->exists($tmpPathDir)){
                $fs->mkdir($tmpPathDir);
            }
            $lang = $request->headers->get('X-File-Lang');
            if($lang && $lang != 'fr'){
                $lang .= '_';
            } else {
                $lang = '';
            }
            $tmpPath = $tmpPathDir . $lang . $filename;
            $path = $basePath  . $lang . $filename;
            file_put_contents($tmpPath, $request->getContent());
            $tmpFile = new File($tmpPath);
            if(!in_array($tmpFile->getMimeType(), ['application/pdf'])){
                $fs->remove($tmpPath);
                $tmpFile = null;
                $response = ['error'=>true,'msg'=>'Le fichier n\'est pas d\'un format acceptable.', 'pdfFilename'=>''];
            } else {
                if($fs->exists($path)){
                    if($lang == ''){
                        $testPr = $this->getRepo('ZPBAdminBundle:PressRelease')->findOneByPdfFr(pathinfo($filename, PATHINFO_FILENAME));
                    } else {
                        $testPr = $this->getRepo('ZPBAdminBundle:PressRelease')->findOneByPdfEn('en_' . pathinfo($filename, PATHINFO_FILENAME));
                    }

                    if(!$testPr || $testPr->getId() == $request->headers->get('X-File-Id')){
                        $test = $this->getRepo('ZPBAdminBundle:MediaPdf')->findOneByFilename(pathinfo($filename, PATHINFO_FILENAME));
                        if($test){
                            $this->getManager()->remove($test);
                            $this->getManager()->flush();
                        }
                        $fs->remove($path);
                        $fs->rename($tmpPath, $path);
                        $file = new File($path);
                        $pdf = $this->get('zpb.pdf_factory')->createFromFile($file);
                        if(null != $institutionSlug = $request->headers->get('X-File-Institution', null)){
                            $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug($institutionSlug);
                            if($institution){
                                $pdf->setInstitution($institution);
                            }
                        }
                        $this->getManager()->persist($pdf);
                        $this->getManager()->flush();
                    } else {
                        $pdf = $this->getRepo('ZPBAdminBundle:MediaPdf')->findOneByFilename(pathinfo($filename, PATHINFO_FILENAME));
                    }



                } else {
                    $fs->rename($tmpPath, $path);
                    $file = new File($path);
                    $pdf = $this->get('zpb.pdf_factory')->createFromFile($file);
                    if(null != $institutionSlug = $request->headers->get('X-File-Institution', null)){
                        $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug($institutionSlug);
                        if($institution){
                            $pdf->setInstitution($institution);
                        }
                    }
                    $this->getManager()->persist($pdf);
                    $this->getManager()->flush();
                }
                $response = ['error'=>false,'msg'=>'Transfert réussi', 'pdfFilename'=>$pdf->getFilename()];
            }
        }

        return new JsonResponse($response);
    }

    public function openRestoAction($id, Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>true, 'msg'=>''];
        $resto = $this->getRepo('ZPBAdminBundle:Restaurant')->find($id);
        if(!$resto){
            $response['msg'] = 'Restaurant introuvable.';
        } else {
            $resto->setIsOpen(true);
            $this->getManager()->persist($resto);
            $this->getManager()->flush();
            $response['error'] = false;
            $response['msg'] = 'Restaurant modifié';
        }
        return new JsonResponse($response);
    }

    public function closeRestoAction($id, Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>true, 'msg'=>''];
        $resto = $this->getRepo('ZPBAdminBundle:Restaurant')->find($id);
        if(!$resto){
            $response['msg'] = 'Restaurant introuvable.';
        } else {
            $resto->setIsOpen(false);
            $this->getManager()->persist($resto);
            $this->getManager()->flush();
            $response['error'] = false;
            $response['msg'] = 'Restaurant modifié';
        }
        return new JsonResponse($response);
    }
}

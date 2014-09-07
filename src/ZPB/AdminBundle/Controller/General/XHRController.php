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
        $response = ['error'=>false,'msg'=>'', 'html'=>''];
        $fs = $this->get('filesystem');
        $filename = $request->headers->get('X-File-Name');

        $basePath = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] . $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir'];
        if(!$fs->exists($basePath)){
            $fs->mkdir($basePath);
        }
        $path = $basePath . '/' . $filename;
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
                if($request->headers->get('X-File-Id', false)){
                    $postToImg = new PostImg();
                    $postToImg->setImgId($image->getId());
                    $postToImg->setPostLongId($request->headers->get('X-File-Id'));
                    $this->getManager()->persist($postToImg);
                    $this->getManager()->flush();
                    $response['html'] = "<img src='" . $webPath . "' width='100%' data-id='" . $image->getId() . "'/>";
                    $response['msg'] = 'Transfert réussi.';
                }
            } catch (\Exception $e){
                $response = ['error'=>true,'msg'=>$e->getMessage(), 'html'=>''];
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
            $postToImg = $this->getRepo('ZPBAdminBundle:PostImg')->findOneByImgId($image->getId());
            if($postToImg){
                $this->getManager()->remove($postToImg);
            }
            $this->getManager()->remove($image);
            $this->getManager()->flush();
            $response['msg'] = 'Image supprimée.';
        }
        return new JsonResponse($response);
    }
}

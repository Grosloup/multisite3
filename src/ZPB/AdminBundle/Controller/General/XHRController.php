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
            $this->getManager()->persist($image);
            $this->getManager()->flush();
            //db save
            $id = 1;
            //resize

            $response['html'] = "<img src='" . $webPath . "' width='100%' data-id='" . $id . "'/>";
            $response['msg'] = 'Transfert réussi.';
        }



        return new JsonResponse($response);
    }

    public function imgDeleteAction($id, Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false,'msg'=>'', 'html'=>''];
        //trouver image, supprimer img

        $response['msg'] = 'Image supprimée.';
        return new JsonResponse($response);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 21:02
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

namespace ZPB\AdminBundle\Controller\Parrainage;


use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class AnimalImageController extends BaseController
{
    public function imagesByAnimalAction($id, Request $request)
    {
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->find($id);
        if(!$animal){
            throw $this->createNotFoundException();
        }

        $hds = $this->getRepo('ZPBAdminBundle:AnimalImageHd')->findByAnimal($animal);
        $fronts = $this->getRepo('ZPBAdminBundle:AnimalImageFront')->findByAnimal($animal);
        $wallpapers = $this->getRepo('ZPBAdminBundle:AnimalImageWallpaper')->findByAnimal($animal);

        return $this->render('ZPBAdminBundle:Parrainage/AnimalImage:images_by_animal.html.twig', ['hds'=>$hds, 'fronts'=>$fronts, 'wallpapers'=>$wallpapers, 'animal'=>$animal]);
    }

    public function deleteHdXhrAction($id, Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $image = $this->getRepo('ZPBAdminBundle:AnimalImageHd')->find($id);
        if(!$image){
            $response = ['error'=>true, 'message'=>'Image inconnue'];
        } else {
            $this->getManager()->remove($image);
            $this->getManager()->flush();
            $response = ['error'=>false, 'message'=>'Image supprimée'];
        }

        return new JsonResponse($response);

    }

    public function addHdXhrAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false, 'message'=>''];
        //verif des données
        $filename = $request->headers->get('X-File-Name', false);
        $filetype = $request->headers->get('X-File-Type', false);
        $filesize = $request->headers->get('X-File-Size', false);
        $animalId = $request->headers->get('X-File-AnimalId', false);
        if(!$filename || !$filesize || !$filetype || !$animalId){
            $response['error'] = true;
            $response['msg' ]= 'Données insuffisantes';
        } else {
            $animal = $this->getRepo('ZPBAdminBundle:Animal')->find($animalId);
            if(!$animal){
                $response['error'] = true;
                $response['msg' ]= 'Animal inconnu';
            }else {
                $fs = $this->get('filesystem');
                $imgFactory = $this->get('zpb.sponsoring.image_hd_factory');
                $basePath = $imgFactory->getBasePath();
                $thumbPath = $imgFactory->getThumbPath();

                if(!$fs->exists($thumbPath)){
                    $fs->mkdir($thumbPath);
                }
                if(!$fs->exists($basePath)){
                    $fs->mkdir($basePath);
                }
                $file = $imgFactory->getPath();
                file_put_contents($file, $request->getContent());
                $file = new File($file);
                if(!in_array($file->getMimeType(), ['image/jpeg'])){
                    $fs->remove($file);
                    $file = null;
                    $response['error'] = true;
                    $response['msg'] = 'Le fichier n\'est pas d\'un format acceptable.';
                } else {
                    $image = $imgFactory->createFromFile($file);
                    $image->setAnimal($animal);
                    $this->getManager()->persist($image);
                    $this->getManager()->flush();
                    $imgFactory->makeThumb($image);
                    $html = '<img src="'.$image->getWebThumbPath().'" width="100%" />';
                    $response = ['error'=>false, 'message'=>'','url'=>$image->getWebThumbPath(),'href'=>$this->generateUrl('zpb_admin_sponsor_animals_delete_xhr_hd_images', ['id'=>$image->getId()]), 'id'=>$image->getId()];
                }
            }

        }
        return new JsonResponse($response);
    }

    public function addFrontXhrAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

    }

    public function addWallpaperXhrAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

    }
}

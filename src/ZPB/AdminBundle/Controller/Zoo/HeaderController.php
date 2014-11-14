<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/11/2014
 * Time: 17:48
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

namespace ZPB\AdminBundle\Controller\Zoo;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Slide;
use ZPB\AdminBundle\Entity\Slider;

class HeaderController extends BaseController
{
    private $institution = 'zoo';
    public function indexAction()
    {
        $slider = $this->getRepo('ZPBAdminBundle:Slider')->findOneByInstitution($this->institution);
        if(!$slider){
            $slider = new Slider();
            $slider->setInstitution('zoo');
            $this->getManager()->persist($slider);
            $this->getManager()->flush();
        }
        $slides = $this->getRepo('ZPBAdminBundle:Slide')->findBy(['slider'=>$slider], ['position'=>'ASC']);
        return $this->render('ZPBAdminBundle:Zoo/Header:index.html.twig', ['slider'=>$slider, 'slides'=>$slides]);
    }

    public function xhrImageUploadAction($id, Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest() ){
            throw $this->createAccessDeniedException();
        }
        /** @var \ZPB\AdminBundle\Entity\Slider $slider */
        $slider = $this->getRepo('ZPBAdminBundle:Slider')->find($id);
        if(!$slider || $slider->getInstitution() != $this->institution){
            throw $this->createNotFoundException();
        }
        $response = ['msg'=>'', 'slide'=>[], 'error'=>true];

        $fs = $this->get('filesystem');
        $webPath = $this->container->getParameter('zpb.carousel.zoo_img_web_dir');
        $basePath = $this->container->getParameter('zpb.carousel.zoo_img_root_dir') . $webPath;

        if(!$fs->exists($basePath)){
            $fs->mkdir($basePath);
        }
        $filename = $request->headers->get('X-File-Name');
        $matches = [];
        $extension = '';
        if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $filename, $matches)){
            $extension = strtolower($matches[1]);
            $newFilename = time() . '.' .$extension;

            file_put_contents($basePath . $newFilename, $request->getContent());
            /** @var \ZPB\AdminBundle\Entity\Slide $slide */
            $slide = new Slide();
            $slide->setImage('/' . $webPath . $newFilename);
            $slide->setImageRoot($basePath . $newFilename);
            $slide->setSlider($slider);
            $this->getManager()->persist($slide);
            $this->getManager()->flush();

            $response['error'] = false;
            $response['slide'] = [
                'id'=>$slide->getId(),
                'url'=>$slide->getImage(),
                'position'=>$slide->getPosition()
            ];
            $response['msg'] = 'Image uploadée.';
        } else {

        }



        return new JsonResponse($response);

    }

    public function xhrDeleteSlideAction($id,Request $request)
    {
        if(!$request->isMethod("GET") || !$request->isXmlHttpRequest() ){
            throw $this->createAccessDeniedException();
        }
        $imgId = $request->query->get('imgId', null);
        $slide = $this->getRepo('ZPBAdminBundle:Slide')->find($imgId);
        $response = ['error'=>true, 'msg'=>''];
        if(!$slide){
            $response['msg'] = 'Données introuvables';
        } else {
            $this->getManager()->remove($slide);
            $this->getManager()->flush();
            $response['error'] = false;
            $response['msg'] = 'Slide bien supprimé';
        }

        return new JsonResponse($response);
    }

    public function xhrUpdateImgPositionAction($id, Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest() ){
            throw $this->createAccessDeniedException();
        }
        /** @var \ZPB\AdminBundle\Entity\Slider $slider */
        $slider = $this->getRepo('ZPBAdminBundle:Slider')->find($id);
        if(!$slider || $slider->getInstitution() != $this->institution){
            throw $this->createNotFoundException();
        }
        $response = ['error'=>true, 'msg'=>'', 'oldPosition'=>null, 'newPosition'=>null];
        $slideId = $request->request->get('id',false);
        $slidePos = $request->request->get('position',false);

        if($slideId === false || $slidePos === false){
            $response['msg'] = 'Données invalides ou manquantes';
        } else {
            $slideId = intval($slideId);
            $slidePos = intval($slidePos);
            /** @var \ZPB\AdminBundle\Entity\Slide $slide */
            $slide = $this->getRepo('ZPBAdminBundle:Slide')->find($slideId);
            if(!$slide){
                $response['msg'] = 'Données introuvables';
            } else {
                $oldPos = $slide->getPosition();
                $slide->setPosition($slidePos);
                $this->getManager()->persist($slide);
                $this->getManager()->flush();
                $response['oldPosition'] = $oldPos;
                $response['newPosition'] = $slidePos;
                $response['error'] = false;
                $response['msg'] = 'Nouvelle position du slide bien enregistrée';
            }
        }


        return new JsonResponse($response);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/09/2014
 * Time: 14:40
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
// use Symfony\Bundle\FrameworkBundle\Controller\Controller; 

class MediaImageController extends BaseController
{
    public function listAction()
    {
        //TODO pagination
        $images = $this->getRepo('ZPBAdminBundle:MediaImage')->findAll();

        return $this->render('ZPBAdminBundle:General/MediaImage:list.html.twig', ['images'=>$images]);
    }

    public function createAction(Request $request)
    {

        return $this->render('ZPBAdminBundle:General/MediaImage:create.html.twig', ['form'=>'']);
    }

    public function updateAction($id, Request $request)
    {
        $image = $this->getRepo('ZPBAdminBundle:MediaImage')->find($id);
        if(!$image){
            throw $this->createNotFoundException(); //TODO
        }
        return $this->render('ZPBAdminBundle:General/MediaImage:update.html.twig', ['form'=>'']);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_media_image')){
            throw $this->createAccessDeniedException(); //TODO
        }
        $image = $this->getRepo('ZPBAdminBundle:MediaImage')->find($id);
        if(!$image){
            throw $this->createNotFoundException(); //TODO
        }
        $lines = $this->getRepo('ZPBAdminBundle:PostImg')->findAllByImg($image);
        if($lines){
            foreach($lines as $line){
                $this->getManager()->remove($line);
            }
        }
        $this->getManager()->remove($image);
        $this->getManager()->flush();
        $this->setSuccess('Image bien supprimée');

        return $this->redirect($this->generateUrl('zpb_admin_media_image_list'));
    }


} 

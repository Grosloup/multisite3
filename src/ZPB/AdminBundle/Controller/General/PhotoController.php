<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 09:44
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
use ZPB\AdminBundle\Form\Type\PhotoType;

class PhotoController extends BaseController
{
    public function listAction()
    {
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findAll();
        return $this->render('ZPBAdminBundle:General:photo/list.html.twig', ['photos'=>$photos]);
    }

    public function createAction(Request $request)
    {
        $photo = $this->get('zpb.photo_factory')->create();
        $form = $this->createForm(new PhotoType(), $photo, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        return $this->render('ZPBAdminBundle:General:photo/create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        return $this->render('ZPBAdminBundle:General:photo/update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {

    }
} 

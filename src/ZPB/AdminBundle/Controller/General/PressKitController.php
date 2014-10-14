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
        return $this->render('ZPBAdminBundle:General/PressKit:update.html.twig', []);
    }

    public function deleteAction($id,Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_press_kit')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:PressKit')->find($id)){
            throw $this->createNotFoundException();
        }
    }

    public function uploadPdfAction(Request $request)
    {

    }

    public function uploadImageAction(Request $request)
    {

    }
}

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

namespace ZPB\AdminBundle\Controller\Zoo;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\PressRelease;
use ZPB\AdminBundle\Form\Type\PressReleaseType;

class PressReleaseController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:PressRelease')->findAll(); //->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:Zoo/PressRelease:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new PressRelease();
        $form = $this->createForm(new PressReleaseType(), $entity);
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

            $this->setSuccess('Nouveau communiqué bien enregistré');
            return $this->redirect($this->generateUrl('zpb_admin_zoo_press_release_list'));
        }
        return $this->render('ZPBAdminBundle:Zoo/PressRelease:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:PressRelease')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PressReleaseType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Communiqué bien modifié');
            return $this->redirect($this->generateUrl('zpb_admin_zoo_press_release_list'));
        }
        return $this->render('ZPBAdminBundle:Zoo/PressRelease:update.html.twig', ['form'=>$form->createView()]);
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
        return $this->redirect($this->generateUrl('zpb_admin_zoo_press_release_list'));
    }

}

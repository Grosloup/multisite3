<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/09/2014
 * Time: 19:05
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
use ZPB\AdminBundle\Entity\PageStatic;
use ZPB\AdminBundle\Form\Type\PageStaticType;

class StaticPageController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:PageStatic')->findAll(); //->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:Zoo/StaticPage:list.html.twig', ['entities'=>$entities]); //1
    }

    public function createAction(Request $request)
    {
        $entity = new PageStatic();
        $form = $this->createForm(new PageStaticType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();

            $this->setSuccess('Nouvelle entité bien enregistrée'); //2
            return $this->redirect($this->generateUrl('')); //3
        }
        return $this->render('ZPBAdminBundle:Zoo/StaticPage:create.html.twig', ['form'=>$form->createView()]); //4
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:PageStatic')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PageStaticType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Entité bien modifiée'); //5
            return $this->redirect($this->generateUrl('')); //6
        }
        return $this->render('ZPBAdminBundle:Zoo/StaticPage:update.html.twig', ['form'=>$form->createView()]); //7
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_static_page')){ //8 intention
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:PageStatic')->find($id)){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        $this->setSuccess('Entité bien supprimée'); //9
        return $this->redirect($this->generateUrl('')); //10
    }

}

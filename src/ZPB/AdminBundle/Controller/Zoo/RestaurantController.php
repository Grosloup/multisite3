<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 11:22
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
use ZPB\AdminBundle\Entity\Restaurant;
use ZPB\AdminBundle\Form\Type\RestaurantType;

class RestaurantController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:Restaurant')->findAll();
        return $this->render('ZPBAdminBundle:Zoo/Restaurant:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new Restaurant();
        $form = $this->createForm(new RestaurantType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();

            $this->setSuccess('Nouveau restaurant bien enregistré');
            return $this->redirect($this->generateUrl('zpb_admin_zoo_restaurants_list'));
        }
        return $this->render('ZPBAdminBundle:Zoo/Restaurant:create.html.twig', ['form'=>$form->createView()]); //4
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:Restaurant')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new RestaurantType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Restaurant bien modifié');
            return $this->redirect($this->generateUrl('zpb_admin_zoo_restaurants_list'));
        }
        return $this->render('ZPBAdminBundle:Zoo/Restaurant:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_resto')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:Restaurant')->find($id)){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        $this->setSuccess('Restaurant bien supprimé');
        return $this->redirect($this->generateUrl('zpb_admin_zoo_restaurants_list'));
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 15:16
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


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\AnimalCategory;
use ZPB\AdminBundle\Form\Type\AnimalCategoryType;

class CategoryController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:AnimalCategory')->findAll(); //->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:Parrainage/Category:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        $entity = new AnimalCategory();
        $form = $this->createForm(new AnimalCategoryType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();

            $this->setSuccess('Nouvelle catégorie bien enregistrée');
            return $this->redirect($this->generateUrl('zpb_admin_sponsor_animals_categories_list'));
        }
        return $this->render('ZPBAdminBundle:Parrainage/Category:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->getRepo('ZPBAdminBundle:AnimalCategory')->find($id);
        if(!$entity){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new AnimalCategoryType(), $entity);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($entity);
            $this->getManager()->flush();
            $this->setSuccess('Catégorie bien modifiée');
            return $this->redirect($this->generateUrl('zpb_admin_sponsor_animals_categories_list'));
        }
        return $this->render('ZPBAdminBundle:Parrainage/Category:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_category')){
            throw $this->createAccessDeniedException();
        }
        if(null == $entity = $this->getRepo('ZPBAdminBundle:AnimalCategory')->find($id)){
            throw $this->createNotFoundException();
        }
        $animals = $entity->getAnimals();
        if(count($animals) < 1){
            $this->getManager()->remove($entity);
            $this->getManager()->flush();
            $this->setSuccess('Catégorie bien supprimée');
            return $this->redirect($this->generateUrl('zpb_admin_sponsor_animals_categories_list'));
        }
        $categories = $this->getRepo('ZPBAdminBundle:AnimalCategory')->findAll();

        return $this->render('ZPBAdminBundle:Parrainage/Category:cant_delete.html.twig', ['category'=>$entity, 'animals'=>$animals, 'categories'=>$categories]);
    }

}

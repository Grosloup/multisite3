<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 16:51
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
use ZPB\AdminBundle\Entity\PhotoCategory;
use ZPB\AdminBundle\Form\Type\PhotoCategoryType;
use ZPB\AdminBundle\Form\Type\PhotoCategoryUpdateType;

class PhotoCategoryController extends BaseController
{
    public function listAction()
    {
        $photoCategories = $this->getRepo('ZPBAdminBundle:PhotoCategory')->findAll();
        return $this->render('ZPBAdminBundle:General/photo_category:list.html.twig', ['categories'=>$photoCategories]);
    }

    public function createAction(Request $request)
    {
        $photoCategory = new PhotoCategory();
        $form = $this->createForm(new PhotoCategoryType(), $photoCategory, ['em'=> $this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){

            $this->getManager()->persist($photoCategory);
            $this->getManager()->flush();

            $this->setSuccess('Catégorie bien enregistrée');
            return $this->redirect($this->generateUrl('zpb_admin_photos_categories_list'));
        }
        return $this->render('ZPBAdminBundle:General/photo_category:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $photoCategory = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($id);
        if(!$photoCategory){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PhotoCategoryUpdateType(), $photoCategory, ['em'=> $this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($photoCategory);
            $this->getManager()->flush();
            $this->setSuccess('Catégorie de photo bien mise à jour.');
            return $this->redirect($this->generateUrl('zpb_admin_photos_categories_list'));
        }
        return $this->render('ZPBAdminBundle:General/photo_category:update.html.twig', ['form'=>$form->createView(), 'name'=>$photoCategory->getName()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token', false), 'delete_category')){
            throw $this->createAccessDeniedException();
        }
        /** @var \ZPB\AdminBundle\Entity\PhotoCategory $category */
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($id);
        if(!$category){
            throw $this->createNotFoundException();
        }
        if($category->hasPhotos()){
            $this->setError('Des photos dépendent de cette catégorie. Modifier celles-ci pour pouvoir supprimer cette catégorie.');
            return $this->redirect($this->generateUrl('zpb_admin_photos_categories_list'));
        }
        $this->getManager()->remove($category);
        $this->getManager()->flush();
        $this->setSuccess('Catégorie de photos bien supprimée');
        return $this->redirect($this->generateUrl('zpb_admin_photos_categories_list'));
    }
}

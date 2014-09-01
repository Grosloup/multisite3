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
        $photCategory = new PhotoCategory();
        $form = $this->createForm(new PhotoCategoryType(), $photCategory);
        $form->handleRequest($request);
        if($form->isValid()){
            //TODO
        }
        return $this->render('ZPBAdminBundle:General/photo_category:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $photoCategory = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($id);
        if(!$photoCategory){
            //TODO
        }
        $form = $this->createForm(new PhotoCategoryUpdateType(), $photoCategory);
        $form->handleRequest($request);
        if($form->isValid()){
            //TODO
        }
        return $this->render('ZPBAdminBundle:General/photo_category:update.html.twig', ['form'=>$form->createView(), 'name'=>$photoCategory->getName()]);
    }

    public function deleteAction($id, Request $request)
    {

    }
} 

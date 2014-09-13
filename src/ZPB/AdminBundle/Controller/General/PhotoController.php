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
use ZPB\AdminBundle\Form\Type\InstitutionChoiceType;
use ZPB\AdminBundle\Form\Type\PhotoType;

class PhotoController extends BaseController
{
    public function listAction()
    {
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findAll();
        $filterInstitutionForm = $this->createForm(new InstitutionChoiceType(), null, [
                'action'=>$this->generateUrl('zpb_admin_photos_list_by_institution')
            ]);
        return $this->render('ZPBAdminBundle:General:photo/list.html.twig',
            [
                'photos'=>$photos,
                'photo_factory'=>$this->get('zpb.photo_factory'),
                'institutionFilter'=>$filterInstitutionForm->createView()
            ]);
    }

    public function listByInstitutionAction(Request $request)
    {
        $formDatas = $request->get('institution_filter_form');
        if(!$formDatas || empty($formDatas) || empty($formDatas['institution'])){
            $this->setError('Recherche impossible');
            return $this->redirect($this->generateUrl('zpb_admin_photos_list'));
        }
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['institutionId'=>intval($formDatas['institution'])]) ;
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->find(intval($formDatas['institution']));
        if(!$institution){
            throw $this->createNotFoundException();
        }
        $categories = $institution->getPhotoCategories();
        $choices = [];
        foreach($categories as $category){
            $choices[$category->getId()] = $category->getName();
        }
        $filterByCategory = $this->get('form.factory')->createNamedBuilder('category_filter_form','form')
            ->setAction($this->generateUrl('zpb_admin_photos_list_by_category'))
            ->add('category', 'choice', ['label'=>'Catégories', 'expanded'=>false, 'multiple'=>false,'choices'=>$choices ])
            ->add('search', 'submit', ['label'=>'Filtrer'])
            ->getForm();
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['institutionId'=>intval($formDatas['institution'])]) ;
        return $this->render('ZPBAdminBundle:General/Photo:list_by_institution.html.twig',
            [
                'photo_factory'=>$this->get('zpb.photo_factory'),
                'photos'=>$photos,
                'institution'=>$institution,
                'filterCategory'=>$filterByCategory->createView()
            ]
        );
    }

    public function listByCategoryAction(Request $request)
    {
        $formDatas = $request->get('category_filter_form');
        if(!$formDatas || empty($formDatas) || empty($formDatas['category'])){
            $this->setError('Recherche impossible');
            return $this->redirect($this->generateUrl('zpb_admin_photos_list'));
        }
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find(intval($formDatas['category']));
        if(!$category){
            throw $this->createNotFoundException();
        }
        /*$photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['category'=>$category], ['position'=>'ASC']);

        return $this->render('ZPBAdminBundle:General/photo:list_by_category.html.twig', ['photo_factory'=>$this->get('zpb.photo_factory'),'photos'=>$photos, 'category'=>$category]);*/
        return $this->forward('ZPBAdminBundle:General/Photo:getListByCategory', ['categoryId'=>$category->getId()]);
    }

    public function chooseInstitutionAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();

        return $this->render('ZPBAdminBundle:General/Photo:choose_institution.html.twig', ['institutions'=>$institutions]);
    }

    public function createAction($institution_slug, Request $request)
    {
        $photo = $this->get('zpb.photo_factory')->create();
        $form = $this->createForm(new PhotoType(), $photo, ['em'=>$this->getManager(), 'slug'=>$institution_slug]);
        $form->handleRequest($request);
        if($form->isValid()){
            $photo->upload();

            $this->getManager()->persist($photo);
            $this->getManager()->flush();

            $this->get('zpb.photo_resizer')->makeThumbnails($photo);
            return $this->redirect($this->generateUrl('zpb_admin_photos_list'));
        }
        return $this->render('ZPBAdminBundle:General:photo/create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            //TODO
        }
        return $this->render('ZPBAdminBundle:General:photo/update.html.twig', []);
    }

    public function positionUpAction($id)
    {
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            throw $this->createNotFoundException();
        }
        $position = $photo->getPosition();
        if($position > 0 ){
            $photo->setPosition($position - 1);
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
        }
        return $this->forward('ZPBAdminBundle:General/Photo:getListByCategory', ['categoryId'=>$photo->getCategory()->getId()]);
    }

    public function positionDownAction($id)
    {
        $photo = $this->getRepo('ZPBAdminBundle:Photo')->find($id);
        if(!$photo){
            throw $this->createNotFoundException();
        }
        $position = $photo->getPosition();
        $last = $this->getRepo('ZPBAdminBundle:Photo')->getLastPositionInCategory($photo->getCategory()->getId());

        if($position < $last ){
            $photo->setPosition($position + 1);
            $this->getManager()->persist($photo);
            $this->getManager()->flush();
        }
        return $this->forward('ZPBAdminBundle:General/Photo:getListByCategory', ['categoryId'=>$photo->getCategory()->getId()]);

    }

    public function getListByCategoryAction($categoryId)
    {
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($categoryId);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['category'=>$category], ['position'=>'ASC']);

        return $this->render('ZPBAdminBundle:General/photo:list_by_category.html.twig', ['photo_factory'=>$this->get('zpb.photo_factory'),'photos'=>$photos, 'category'=>$category]);
    }

    public function deleteAction($id, Request $request)
    {

    }
}

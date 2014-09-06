<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 10:45
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
use ZPB\AdminBundle\Entity\PostCategory;
use ZPB\AdminBundle\Form\Type\PostCategoryType;

class PostCategoryController extends BaseController
{
    public function listAction()
    {
        $categories = $this->getRepo('ZPBAdminBundle:PostCategory')->findBy([], ['name'=> 'ASC']);
        return $this->render('ZPBAdminBundle:General:post_category/list.html.twig', ['categories'=>$categories]);
    }

    public function createAction(Request $request)
    {
        $category = new PostCategory();
        $form = $this->createForm(new PostCategoryType(), $category);

        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($category);
            $this->getManager()->flush();

            $this->setSuccess('Nouvelle catégorie d\'actualité bien enregistrée');
            return $this->redirect($this->generateUrl('zpb_admin_posts_categories_list'));
        }
        return $this->render('ZPBAdminBundle:General:post_category/create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        return $this->render('ZPBAdminBundle:General:post_category/update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {

    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/10/2014
 * Time: 10:36
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
use ZPB\AdminBundle\Entity\Post;
use ZPB\AdminBundle\Form\type\PostType;

class PostController extends BaseController
{
    public function listAction()
    {
        return $this->render('ZPBAdminBundle:General/Post:list.html.twig', []);
    }

    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($post);
            $this->getManager()->flush();


            if($form->get('save')->isClicked()){
                return $this->redirect($this->generateUrl('zpb_sites_zoo_actualites_list'));
            }

            if($form->get('publish')->isClicked()){

            }
        }
        return $this->render('ZPBAdminBundle:General/Post:create.html.twig', []);
    }

    public function publishAction($id)
    {
        return $this->render('ZPBAdminBundle:General/Post:publish.html.twig', []);
    }

    public function updateAction($id, Request $request)
    {
        return $this->render('ZPBAdminBundle:General/Post:update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {

    }
}

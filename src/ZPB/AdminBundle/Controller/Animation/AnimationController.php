<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 02/09/14
 * Time: 15:31
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

namespace ZPB\AdminBundle\Controller\Animation;



use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Animation;
use ZPB\AdminBundle\Form\Type\AnimationType;


class AnimationController extends BaseController
{
    public function listAction()
    {
        $animations = $this->getRepo('ZPBAdminBundle:Animation')->findAll();

        return $this->render('ZPBAdminBundle:Animation:animation/list.html.twig', ['animations'=>$animations]);
    }

    public function createAction(Request $request)
    {
        $animation = new Animation();
        $form = $this->createForm(new AnimationType(), $animation);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($animation);
            $this->getManager()->flush();
            $this->setSuccess('La nouvelle animation, ' . $animation->getName() . ' bien enregistée.');
            return $this->redirect($this->generateUrl('zpb_admin_animations_list'));
        }

        return $this->render('ZPBAdminBundle:Animation:animation/create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $animation = $this->getRepo('ZPBAdminBundle:Animation')->find($id);
        if(!$animation){
            //TODO
        }
        $form = $this->createForm(new AnimationType(), $animation);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($animation);
            $this->getManager()->flush();
            $this->setSuccess('L\'animation, ' . $animation->getName() . ' bien modifiée.');
            return $this->redirect($this->generateUrl('zpb_admin_animations_list'));
        }
        return $this->render('ZPBAdminBundle:Animation:animation/update.html.twig', ['form'=>$form->createView(), 'name'=>$animation->getName()]);
    }

    public function deleteAction($id, Request $request)
    {

    }
} 

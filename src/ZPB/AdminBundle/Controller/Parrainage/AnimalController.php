<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/09/2014
 * Time: 12:58
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
use ZPB\AdminBundle\Entity\Animal;
use ZPB\AdminBundle\Form\Type\AnimalType;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnimalController extends BaseController
{
    public function listAction()
    {
        //TODO html.twig
        $animals = $this->getRepo('ZPBAdminBundle:Animal')->findAll();
        return $this->render('ZPBAdminBundle:Parrainage/Animal:list.html.twig', ['animals'=>$animals]);
    }

    public function createAction(Request $request)
    {
        $animal = new Animal();
        $form = $this->createForm(new AnimalType(), $animal, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($animal);
            $this->getManager()->flush();
            $this->setSuccess("Nouvelle animal bien enregistré.");
            return $this->redirect($this->generateUrl('zpb_admin_sponsor_animals_list'));
        }
        return $this->render('ZPBAdminBundle:Parrainage/Animal:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        //TODO
    }

    public function deleteAction($id, Request $request)
    {
        //TODO
    }
} 

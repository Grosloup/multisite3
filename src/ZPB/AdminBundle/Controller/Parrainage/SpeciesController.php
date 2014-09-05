<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/09/2014
 * Time: 16:26
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
use ZPB\AdminBundle\Entity\AnimalSpecies;
use ZPB\AdminBundle\Form\Type\SponsoringSpeciesType;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SpeciesController extends BaseController
{
    public function listAction()
    {
        $species = $this->getRepo('ZPBAdminBundle:AnimalSpecies')->findAll();
        return $this->render('ZPBAdminBundle:Parrainage/Species:list.html.twig', ['species'=>$species]);
    }

    public function createAction(Request $request)
    {
        $species = new AnimalSpecies();
        $form = $this->createForm(new SponsoringSpeciesType(), $species);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($species);
            $this->getManager()->flush();
            $this->setSuccess('Nouvelle espèce bien enregistrée.');
            return $this->redirect($this->generateUrl('zpb_admin_sponsor_species_list'));
        }
        return $this->render('ZPBAdminBundle:Parrainage/Species:create.html.twig', ['form'=>$form->createView()]);
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

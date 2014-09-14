<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/09/2014
 * Time: 16:43
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
use ZPB\AdminBundle\Entity\Institution;
use ZPB\AdminBundle\Form\Type\InstitutionType;

class InstitutionsController extends BaseController
{
    public function listAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();
        return $this->render('ZPBAdminBundle:General/Institution:list.html.twig', ['institutions' => $institutions]);
    }

    public function createAction(Request $request)
    {
        $institution = new Institution();
        $form = $this->createForm(new InstitutionType(), $institution);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getManager()->persist($institution);
            $this->getManager()->flush();
            $this->setSuccess('Nouvelle institution créée.');
            return $this->redirect($this->generateUrl('zpb_admin_institutions_list'));
        }

        return $this->render('ZPBAdminBundle:General/Institution:create.html.twig', ['form' => $form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->find($id);
        if (!$institution) {
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new InstitutionType(), $institution);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getManager()->persist($institution);
            $this->getManager()->flush();
            $this->setSuccess('Institution bien modifiée');
            return $this->redirect($this->generateUrl('zpb_admin_institutions_list'));
        }

        return $this->render('ZPBAdminBundle:General/Institution:update.html.twig', ['form' => $form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        if(!$this->validateToken($request->query->get('_token'), 'delete_institution')){
            throw $this->createAccessDeniedException();
        }
        /** @var \ZPB\AdminBundle\Entity\Institution $institution */
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->find($id);
        if (!$institution) {
            throw $this->createNotFoundException();
        }
        if($institution->hasPhotoCategories()){
            $this->setError('Des catégories de photo dépendent de cette institution. Modifier celles-ci pour pouvoir supprimer cette institution.');
            return $this->redirect($this->generateUrl('zpb_admin_institutions_list'));
        }
        if($institution->hasFaqs()){
            $this->setError('Des FAQ dépendent de cette institution. Modifier celles-ci pour pouvoir supprimer cette institution.');
            return $this->redirect($this->generateUrl('zpb_admin_institutions_list'));
        }
        $this->getManager()->remove($institution);
        $this->getManager()->flush();
        $this->setSuccess('Institution bien supprimée');
        return $this->redirect($this->generateUrl('zpb_admin_institutions_list'));
    }
}

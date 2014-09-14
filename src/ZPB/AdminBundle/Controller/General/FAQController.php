<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/09/2014
 * Time: 17:25
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
use ZPB\AdminBundle\Entity\FAQ;
use ZPB\AdminBundle\Form\Type\FAQType;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FAQController extends BaseController
{
    public function listAction()
    {
        $faqs = $this->getRepo('ZPBAdminBundle:FAQ')->findAll();
        return $this->render('ZPBAdminBundle:General/faq:list.html.twig', ['faqs'=>$faqs]);
    }

    public function createAction(Request $request)
    {
        $faq = new FAQ();
        $form = $this->createForm(new FAQType(), $faq, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($faq);
            $this->getManager()->flush();
            return $this->redirect($this->generateUrl('zpb_admin_faq_list'));
        }
        return $this->render('ZPBAdminBundle:General/faq:create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        /** @var \ZPB\AdminBundle\Entity\FAQ $faq */
        $faq = $this->getRepo('ZPBAdminBundle:FAQ')->find($id);
        if(!$faq){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new FAQType(), $faq, ['em'=>$this->getManager()]);

        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($faq);
            $this->getManager()->flush();
            return $this->redirect($this->generateUrl('zpb_admin_faq_list'));
        }
        return $this->render('ZPBAdminBundle:General/faq:update.html.twig', ['form'=>$form->createView()]);
    }

    public function deleteAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        if(!$this->validateToken($token, 'delete_faq')){
            throw $this->createAccessDeniedException();
        }
        $faq = $this->getRepo('ZPBAdminBundle:FAQ')->find($id);
        if(!$faq){
            throw $this->createNotFoundException();
        }
        $this->getManager()->remove($faq);
        $this->getManager()->flush();
        $this->setSuccess('FAQ bien effacé');

        return $this->redirect($this->generateUrl('zpb_admin_faq_list'));
    }
}

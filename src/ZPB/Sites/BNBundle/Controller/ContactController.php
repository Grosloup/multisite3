<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 24/09/2014
 * Time: 15:17
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

namespace ZPB\Sites\BNBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\ContactInfo;
use ZPB\Sites\BNBundle\Form\Type\ContactType;

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        $contact = new ContactInfo();
        $contact->setSource('Beauval Nature');

        $form = $this->createForm(new ContactType(), $contact);
        $form->handleRequest($request);
        if($form->isValid()){
            $nonHuman = $form->get('name')->getData();
            if($nonHuman != null){
                throw new AccessDeniedException();
            }
            $this->getManager()->persist($contact);
            $this->getManager()->flush();
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('mail de contact')
                ->setFrom('nicolas.canfrere@zoobeauval.com') //TODO adresse mail
                ->setTo('beauval.nature@zoobeauval.com')
                ->setBody($this->renderView('ZPBSitesZooBundle:Emails:contact_info.html.twig',['contact'=>$contact]))
            ;

            $sent = $this->get('mailer')->send($message);

            if($sent>0){
                $this->setSuccess('Un email vous a été envoyé avec un nouveau de passe !');
            }else {
                $this->setError('Un problème est survenu !');
            }
        }

        return $this->render('ZPBSitesBNBundle:Contact:index.html.twig', ['form'=>$form->createView()]);
    }
} 

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/11/2014
 * Time: 17:10
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

namespace ZPB\Sites\ZooBundle\Controller\English;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\ContactInfo;
use ZPB\Sites\ZooBundle\Form\Type\EnglishContactType;

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        $contact = new ContactInfo();

        $contact->setSource('ZooParc de Beauval')->setInterlocutor('info');

        $form = $this->createForm(new EnglishContactType(), $contact);
        $form->handleRequest($request);
        if($form->isValid()){
            $nonHuman = $form->get('name')->getData();
            if($nonHuman != null){
                throw $this->createAccessDeniedException();
            }

            $this->getManager()->persist($contact);
            $this->getManager()->flush();

            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('mail de contact')
                ->setFrom('nicolas.canfrere@zoobeauval.com') //TODO adresse mail
                ->setTo($this->container->getParameter('zpb.zoo.contact_interlocutors_emails')[$contact->getInterlocutor()])
                ->setBody($this->renderView('ZPBSitesZooBundle:Emails:contact_info.html.twig',['contact'=>$contact, 'email'=>$this->container->getParameter('zpb.zoo.contact_interlocutors_emails')[$contact->getInterlocutor()]]))
            ;

            $sent = $this->get('mailer')->send($message);

            if($sent>0){
                $this->setSuccess('Votre message a bien été envoyé.');
            }else {
                $this->setError('Un problème est survenu !');
            }
        }

        return $this->render('ZPBSitesZooBundle:English/Contact:index.html.twig', ['form'=>$form->createView()]);
    }
} 

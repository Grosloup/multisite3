<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 18/09/2014
 * Time: 06:24
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

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\ContactInfoZoo;
use ZPB\Sites\ZooBundle\Form\Type\ContactType;

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        $contact = new ContactInfoZoo();

        $form = $this->createForm(new ContactType(), $contact);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($contact);
            $this->getManager()->flush();
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('mail de contact')
                ->setFrom('nicolas.canfrere@zoobeauval.com')
                ->setTo('infos@zoobeauval.com')
                ->setBody($this->renderView('ZPBSitesZooBundle:Emails:contact_info.html.twig',['contact'=>$contact]))
            ;

            $sent = $this->get('mailer')->send($message);

            if($sent>0){
                $this->setSuccess('Un email vous a été envoyé avec un nouveau de passe !');
            }else {
                $this->setError('Un problème est survenu !');
            }

        }
        return $this->render('ZPBSitesZooBundle:Contact:index.html.twig', ['form'=>$form->createView()]);
    }
}

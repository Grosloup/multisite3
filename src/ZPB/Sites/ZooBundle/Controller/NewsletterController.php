<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 20/09/2014
 * Time: 21:12
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
use ZPB\AdminBundle\Entity\NewsletterSubscriber;
use ZPB\Sites\ZooBundle\Form\Type\NewsLetterSubscribeType;

class NewsletterController extends BaseController
{
    public function subscribeAction(Request $request)
    {
        $subscriber = new NewsletterSubscriber();

        $form = $this->createForm(new NewsLetterSubscribeType(), $subscriber);

        $form->handleRequest($request);
        if($form->isValid()){
            $honeyPot = $form->get('name')->getData();

            if($honeyPot != null){
                throw $this->createAccessDeniedException();
            }
            $target = $this->getRepo('ZPBAdminBundle:PostTarget')->findOneByAcronym('zb');
            $subscriber->setTarget($target);

            $this->getManager()->persist($subscriber);
            $this->getManager()->flush();

            return $this->redirect($this->generateUrl('zpb_sites_zoo_newsletter_thanks', ['id'=>$subscriber->getId()]));
        }

        return $this->render('ZPBSitesZooBundle:Newsletter:subscribe.html.twig', ['form'=>$form->createView()]);
    }

    public function thanksForSubscribeAction($id)
    {
        $subscriber = $this->getRepo('ZPBAdminBundle:NewsletterSubscriber')->find($id);
        if(!$subscriber){
            throw $this->createNotFoundException();
        }

        return $this->render('ZPBSitesZooBundle:Newsletter:subscribe_thanks.html.twig', ['subscriber'=>$subscriber]);
    }
}

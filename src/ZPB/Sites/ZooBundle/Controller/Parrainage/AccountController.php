<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/09/2014
 * Time: 08:50
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

namespace ZPB\Sites\ZooBundle\Controller\Parrainage;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\Sites\ZooBundle\Form\Model\ChangePassword;
use ZPB\Sites\ZooBundle\Form\Type\MyAccountType;
use ZPB\Sites\ZooBundle\Form\Type\NewPasswordType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AccountController extends BaseController
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        return $this->render('ZPBSitesZooBundle:Parrainage/Account:login.html.twig', ['error'=>$error, 'last_username'=>$lastUsername]);
    }

    public function myAccountAction(Request $request)
    {

        $user = $this->getUser();

        if(!$user || true !== $this->get('security.context')->isGranted('ROLE_GODPARENT')){
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(new MyAccountType(), $user);

        $changePasswordModel = new ChangePassword();
        $pw_form = $this->createForm(new NewPasswordType(), $changePasswordModel);

        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($user);
            $this->getManager()->flush();
            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainage_my_account'));
        }

        $pw_form->handleRequest($request);
        if($pw_form->isValid()){

        }
        return $this->render('ZPBSitesZooBundle:Parrainage/Account:my_account.html.twig',
            [
                'form'      =>  $form->createView(),
                'pw_form'   =>  $pw_form->createView()
            ]);
    }

    public function lostPasswordAction(Request $request)
    {
        $formBuilder = $this->createFormBuilder();
        $notBlank = new NotBlank();
        $notBlank->message = 'Ce champs est requis.';
        $email = new Email();
        $email->message = 'L\'email n\'est pas valide.';
        $formBuilder
            ->add('email',
                'email',
                [
                    'label'=>'Entrez votre email',
                    'constraints'=>[
                        $notBlank,
                        $email
                    ]
                ]
            )
            ->add('save', 'submit', ['label'=>'Envoyer']);
        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $email = $form->get('email')->getData();
            // recherche du parrain
            $repo = $this->getRepo('ZPBAdminBundle:Godparent');
            $godparent = $repo->findOneByEmail($email);
            if(!$godparent){
                throw $this->createNotFoundException();
            }

            $newPass = $repo->createPassword();

            $godparent->setPlainPassword($newPass);
            $godparent->setIsActive(false);
            $date = (new \DateTime())->getTimestamp() + (30*24*60*60);
            $tmp = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
            $godparent->setTmp($tmp);
            $this->getManager()->persist($godparent);
            $this->getManager()->flush();
            $link = $this->generateUrl('zpb_sites_zoo_parrainages_revalidate',['ref'=>$tmp,'email'=>$email, 'validation'=>$date], UrlGeneratorInterface::ABSOLUTE_URL);
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('email test')
                ->setFrom('nicolas.canfrere@zoobeauval.com')
                ->setTo('nicolas.canfrere@zoobeauval.com')
                ->setBody($this->renderView('ZPBAdminBundle:Mails:test.html.twig',['password'=>$newPass, 'link'=>$link]))
                ;

            $sent = $this->get('mailer')->send($message);

            if($sent>0){
                $this->setSuccess('Un email vous a été envoyé avec un nouveau de passe !');
            }else {
                $this->setError('Un problème est survenu !');
            }

            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_homepage'));
        }

        return $this->render('ZPBSitesZooBundle:Parrainage/Account:new_id.html.twig', ['form'=>$form->createView()]);

    }

    public function activationLinkAction(Request $request)
    {
        $email = $request->query->get('email');
        $ref = $request->query->get('ref');
        $validation = $request->query->get('validation');
        $now = (new \DateTime())->getTimestamp();
        $errors = [];
        if($now>$validation){
            $errors[] = 'Date invalide.';
        }
        $repo = $this->getRepo('ZPBAdminBundle:Godparent');
        $godparent = $repo->findOneByEmail($email);
        if(!$godparent){
            $errors[] = 'Utilisateur inconnu.';
        }
        if($godparent->getTmp() != $ref){
            $errors[] = 'Ref non valide.';
        }

        if($errors){
            return $this->createAccessDeniedException(); //TODO erreur nouveau id
        }
        $godparent->setIsActive(true);
        $this->getManager()->persist($godparent);
        $this->getManager()->flush();
        return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_login'));
    }
} 

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
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\Sites\ZooBundle\Form\Model\ChangePassword;
use ZPB\Sites\ZooBundle\Form\Type\MyAccountType;
use ZPB\Sites\ZooBundle\Form\Type\NewPasswordType;

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
} 

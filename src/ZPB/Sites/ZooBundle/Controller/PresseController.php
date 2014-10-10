<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
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
use Symfony\Component\Security\Core\SecurityContextInterface;
use ZPB\AdminBundle\Controller\BaseController;

class PresseController extends BaseController
{
    public function communiqueAction()
    {
        $pr = $this->getRepo('ZPBAdminBundle:PressRelease')->findAll(); //TODO order by updated_at
        return $this->render('ZPBSitesZooBundle:Presse:communiques.html.twig', ['prs'=>$pr]);
    }

    public function dossierAction()
    {
        return $this->render('ZPBSitesZooBundle:Presse:dossiers.html.twig', []);
    }

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
        return $this->render('ZPBSitesZooBundle:PhotothequeHd/PhotoHd:login.html.twig', ['error'=>$error, 'last_username'=>$lastUsername]);
    }
}

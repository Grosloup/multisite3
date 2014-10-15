<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/10/2014
 * Time: 16:59
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

namespace ZPB\Sites\ZooMobileBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class PratiqueController extends BaseController
{
    public function accesAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Pratique:acces.html.twig', []);
    }

    public function horairesTarifsAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Pratique:horaires_tarifs.html.twig', []);
    }

    public function animationsSpectaclesAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Pratique:animations_spectacles.html.twig', []);
    }

    public function restaurationAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Pratique:restauration.html.twig', []);
    }

    public function servicesAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Pratique:services.html.twig', []);
    }

    public function faqAction()
    {
        return $this->render('ZPBSitesZooMobileBundle:Pratique:faq.html.twig', []);
    }

}

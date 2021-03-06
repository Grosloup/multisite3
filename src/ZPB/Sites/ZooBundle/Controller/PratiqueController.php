<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/09/14
 * Time: 08:24
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


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class PratiqueController extends BaseController
{
    public function tarifsHorairesAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:tarifs.html.twig', []);
    }

    public function accesAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:acces.html.twig', []);
    }

    public function animationsAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:animations.html.twig', []);
    }

    public function mapAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:map.html.twig', []);
    }

    public function restoAction()
    {
        $restos = $this->getRepo('ZPBAdminBundle:Restaurant')->findAll();
        return $this->render('ZPBSitesZooBundle:Pratique:resto.html.twig', ['restos'=>$restos]);
    }

    public function servicesAction()
    {
        return $this->render('ZPBSitesZooBundle:Pratique:services.html.twig', []);
    }

    public function apiInfoAnimAction($year, $month, $day, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("GET")){
            throw $this->createNotFoundException();
        }

        $date = new \DateTime($year."/".$month."/".$day);

        return new JsonResponse(["message"=>$date->format("y-m-d H:i:s")]);
    }


}

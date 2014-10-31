<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 27/10/2014
 * Time: 19:40
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

namespace ZPB\AdminBundle\Controller\Animation;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class PlanningController extends BaseController
{
    public function indexAction()
    {
        $animDays = $this->getRepo('ZPBAdminBundle:AnimationDay')->findAll();
        return $this->render('ZPBAdminBundle:Animation:planning/index.html.twig', ['animationDays'=>json_encode($animDays)]);
    }


    public function apiGetDaysInMonthAction($year, $month, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("GET")){
            throw $this->createAccessDeniedException();
        }



        $datas = $this->getRepo('ZPBAdminBundle:AnimationProgram')->getAnimationsInMonth($month, $year);

        return new JsonResponse($datas);
    }

    public function apiDeleteDayAction($id,$year, $month,$day, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("DELETE")){
            throw $this->createAccessDeniedException();
        }
    }
}

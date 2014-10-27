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
        return $this->render('ZPBAdminBundle:Animation:planning/index.html.twig', []);
    }


    public function apiGetDaysInMonthAction($year, $month, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("GET")){
            throw $this->createAccessDeniedException();
        }

        $blue = '#5f9eff';
        $orange = '#ff9744';
        $green = '#5dd46a';
        $datas = [
            'year'=>$year,
            'month'=>$month,
            'days' => [
                [],[$orange],[$blue],[$blue],[],[],[$green],[],[],[$blue, $orange],
                [],[$orange],[],[],[],[$green,$blue],[],[],[],[$green],
                [],[$orange],[],[$orange],[],[$green],[$blue],[$blue],[],[$orange],
                [$green]
            ]
        ];

        return new JsonResponse($datas);
    }
}

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


    public function apiGetDaysInMonthAction($month, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("GET")){
            throw $this->createAccessDeniedException();
        }

        return new JsonResponse([['id'=>1, 'name'=>'test1'], ['id'=>2, 'name'=>'test2'], ['id'=>3, 'name'=>'test3']]);
    }
}

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
use ZPB\AdminBundle\Entity\AnimationProgram;

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

    public function apiAddDaysAction($id, $year, $month, $day, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("POST")){
            throw $this->createAccessDeniedException();
        }
        $animationDay = $this->getRepo('ZPBAdminBundle:AnimationDay')->find($id);
        if(!$animationDay){
            throw $this->createNotFoundException();
        }
        $date = \DateTime::createFromFormat('Y/n/j', $year.'/'.$month.'/'.$day);
        /** @var \ZPB\AdminBundle\Entity\AnimationProgram $program */
        $program = $this->getRepo('ZPBAdminBundle:AnimationProgram')->findOneByDaytime($date);
        if(!$program){

            $program = new AnimationProgram();
            $program->setDaytime($date);
            $this->getManager()->persist($program);
            $this->getManager()->flush();
            //throw $this->createNotFoundException();
        }
        $program->addAnimationDay($animationDay);
        $this->getManager()->persist($program);
        $this->getManager()->flush();

        return new JsonResponse(["error"=>false, "message"=>$program->getId()]);
    }

    public function apiDeleteDayAction($id, $year, $month, $day, Request $request)
    {
        if(!$request->isXmlHttpRequest() && !$request->isMethod("DELETE")){
            throw $this->createAccessDeniedException();
        }
        $animationDay = $this->getRepo('ZPBAdminBundle:AnimationDay')->find($id);
        if(!$animationDay){
            throw $this->createNotFoundException();
        }
        /** @var \ZPB\AdminBundle\Entity\AnimationProgram $program */
        $program = $this->getRepo('ZPBAdminBundle:AnimationProgram')->findOneByDaytime(\DateTime::createFromFormat('Y/n/j', $year.'/'.$month.'/'.$day));
        if(!$program){
            throw $this->createNotFoundException();
        }
        $program->removeAnimationDay($animationDay);
        $this->getManager()->persist($program);
        $this->getManager()->flush();

        return new JsonResponse(["error"=>false, "message"=>$program->getId()]);
    }
}

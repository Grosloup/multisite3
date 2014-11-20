<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 02/09/14
 * Time: 14:46
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
use ZPB\AdminBundle\Entity\AnimationDay;
use ZPB\AdminBundle\Entity\AnimationSchedule;
use ZPB\AdminBundle\Form\Type\AnimationDayType;

class DayController extends BaseController
{
    public function listAction()
    {
        $animationDays = $this->getRepo('ZPBAdminBundle:AnimationDay')->findAll();
        $animations = $this->getRepo('ZPBAdminBundle:Animation')->findAllToArray();
        return $this->render('ZPBAdminBundle:Animation:day/list.html.twig', ['animDays'=>$animationDays, 'animations'=>$animations]);
    }

    public function createAction(Request $request)
    {
        $animationDay = new AnimationDay();
        $animationDay->setColor('30b34e');
        $form=$this->createForm(new AnimationDayType(), $animationDay, ['em'=>$this->getManager()]);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getManager();
            foreach($animationDay->getSchedules() as $schedule){
                $schedule->setAnimationDay($animationDay);
                $em->persist($schedule);
            }


            $em->persist($animationDay);
            $em->flush();
        }
        return $this->render('ZPBAdminBundle:Animation:day/create.html.twig', ['form'=>$form->createView()]);
    }

    public function updateAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {

    }

    public function xhrScheduleChangeHourAction(Request $request)
    {
        if(!$request->isMethod('POST') || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>true, 'msg'=>'Données Manquantes.'];
        $scheduleId = $request->request->get('id', false);
        $hour = $request->request->get('hour', false);
        if($scheduleId !== false && $hour !== false){
            $scheduleId = intval($scheduleId);
            $hour = (intval($hour)<10) ? '0' . $hour : $hour;
            /** @var \ZPB\AdminBundle\Entity\AnimationSchedule $schedule */
            $schedule = $this->getRepo('ZPBAdminBundle:AnimationSchedule')->find($scheduleId);
            if($schedule){
                $min = $schedule->getTimetable()->format('i');

                $date = \DateTime::createFromFormat('H:i:s', $hour . ':' . $min . ':00' );

                $schedule->setTimetable($date);
                $this->getManager()->persist($schedule);
                $this->getManager()->flush();
                $response['error'] = true;
                $response['msg'] = 'Horaire modifié';
            }
        }

        return new JsonResponse($response);
    }

    public function xhrScheduleChangeMinAction(Request $request)
    {
        if(!$request->isMethod('POST') || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>true, 'msg'=>'Données Manquantes.'];
        $scheduleId = $request->request->get("id", false);
        $min = $request->request->get("min", false);
        if($scheduleId !== false && $min !== false){
            $scheduleId = intval($scheduleId);
            //$min = (intval($min)<10) ? '0' . $min : $min;
            /** @var \ZPB\AdminBundle\Entity\AnimationSchedule $schedule */
            $schedule = $this->getRepo('ZPBAdminBundle:AnimationSchedule')->find($scheduleId);
            if($schedule){
                $hour = $schedule->getTimetable()->format('H');
                $date = \DateTime::createFromFormat('H:i:s', $hour . ':' . $min . ':00' );

                $schedule->setTimetable($date);
                $this->getManager()->persist($schedule);
                $this->getManager()->flush();
                $response['error'] = true;
                $response['msg'] = 'Horaire modifié';
                
            }
        }

        return new JsonResponse($response);
    }

    public function xhrAddScheduleToDayAction(Request $request)
    {
        if(!$request->isMethod('POST') || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>true, 'msg'=>'Données Manquantes.', 'horaire'=>null];
        $dayId = $request->request->get('dayId', false);
        $hour = $request->request->get('hour', false);
        $min = $request->request->get('min', false);
        $animId = $request->request->get('animId', false);
        if($dayId !== false && $hour !== false && $min !== false && $animId !== false){
            /** @var \ZPB\AdminBundle\Entity\AnimationDay $animationDay */
            $animationDay = $this->getRepo('ZPBAdminBundle:AnimationDay')->find(intval($dayId));
            /** @var \ZPB\AdminBundle\Entity\Animation $animationDay */
            $animation = $this->getRepo('ZPBAdminBundle:Animation')->find(intval($animId));

            if($animationDay !== null && $animation !== null){
                $schedule = new AnimationSchedule();
                $schedule->setAnimation($animation);
                $date = \DateTime::createFromFormat('H:i:s', $hour.':'.$min.':00');
                $schedule->setTimetable($date);
                $schedule->setAnimationDay($animationDay);
                $this->getManager()->persist($schedule);

                $this->getManager()->flush();
                $response['error'] = false;
                $response['msg'] = 'Horaire enregistré';
                $response['horaire'] = ['id'=>$schedule->getId(), 'animation'=>$animation->getName()];
            }

        }



        return new JsonResponse($response);
    }


}

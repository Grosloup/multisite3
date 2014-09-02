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



use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\AnimationDay;
use ZPB\AdminBundle\Form\Type\AnimationDayType;

class DayController extends BaseController
{
    public function listAction()
    {
        $animationDays = $this->getRepo('ZPBAdminBundle:AnimationDay')->findAll();
        return $this->render('ZPBAdminBundle:Animation:day/list.html.twig', ['animDays'=>$animationDays]);
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
}

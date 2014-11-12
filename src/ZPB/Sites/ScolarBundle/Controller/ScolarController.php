<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/11/2014
 * Time: 16:28
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

namespace ZPB\Sites\ScolarBundle\Controller;


use ZPB\AdminBundle\Controller\BaseController;

class ScolarController extends BaseController
{
    public function cycleOneAction()
    {
        return $this->render('ZPBSitesScolarBundle:Scolar:cycle_one.html.twig', []);
    }

    public function cycleTwoAction()
    {
        return $this->render('ZPBSitesScolarBundle:Scolar:cycle_two.html.twig', []);
    }

    public function cycleThreeAction()
    {
        return $this->render('ZPBSitesScolarBundle:Scolar:cycle_three.html.twig', []);
    }

    public function collegesAction()
    {
        return $this->render('ZPBSitesScolarBundle:Scolar:colleges.html.twig', []);
    }

    public function jdAction()
    {
        return $this->render('ZPBSitesScolarBundle:Scolar:jd.html.twig', []);
    }


} 

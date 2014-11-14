<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/11/2014
 * Time: 17:48
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

namespace ZPB\AdminBundle\Controller\Zoo;


use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Slider;

class HeaderController extends BaseController
{
    public function indexAction()
    {
        $slider = $this->getRepo('ZPBAdminBundle:Slider')->findOneByInstitution('zoo');
        if(!$slider){
            $slider = new Slider();
            $slider->setInstitution('zoo');
            $this->getManager()->persist($slider);
            $this->getManager()->flush();
        }
        $slides = $this->getRepo('ZPBAdminBundle:Slide')->findBy(['slider'=>$slider], ['position'=>'ASC']);
        return $this->render('ZPBAdminBundle:Zoo/Header:index.html.twig', ['slider'=>$slider, 'slides'=>$slides]);
    }
} 

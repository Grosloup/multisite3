<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 17/11/2014
 * Time: 17:36
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

namespace ZPB\AdminBundle\Controller\BeauvalNature;


use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Slider;

class HeaderController extends BaseController
{
    private $institution = 'bn';

    public function indexAction()
    {
        $slider = $this->getRepo('ZPBAdminBundle:Slider')->findOneByInstitution($this->institution);
        if(!$slider){
            $slider = new Slider();
            $slider->setInstitution($this->institution);
            $this->getManager()->persist($slider);
            $this->getManager()->flush();
        }
        $slides = $this->getRepo('ZPBAdminBundle:Slide')->findBy(['slider'=>$slider], ['position'=>'ASC']);

        return $this->render('ZPBAdminBundle:BeauvalNature/Header:index.html.twig', ['slider'=>$slider, 'slides'=>$slides]);
    }
} 

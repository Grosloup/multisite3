<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 17/11/2014
 * Time: 11:12
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

namespace ZPB\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\AdminBundle\Entity\Slide;
use ZPB\AdminBundle\Entity\Slider;

class LoadSlides extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
    * @var \Symfony\Component\DependencyInjection\ContainerInterface
    */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $slider = $this->getReference('zpb-slider-zoo');

        /** @var \ZPB\AdminBundle\Entity\Slide $slide */
        $slide1 = new Slide();
        $slide1->setImage('/img/sites/zoo/headers/1416216205.jpg')
            ->setImageRoot('/var/www/vhosts/multisite3/app/../web/img/sites/zoo/headers/1416216205.jpg')
            ->setIsActive(true)
            ->setSlider($slider);
        $manager->persist($slide1);

        $slide2 = new Slide();
        $slide2->setImage('/img/sites/zoo/headers/1416217990.jpg')
            ->setImageRoot('/var/www/vhosts/multisite3/app/../web/img/sites/zoo/headers/1416217990.jpg')
            ->setIsActive(true)
            ->setSlider($slider);
        $manager->persist($slide2);

        $slide3 = new Slide();
        $slide3->setImage('/img/sites/zoo/headers/1416218080.jpg')
            ->setImageRoot('/var/www/vhosts/multisite3/app/../web/img/sites/zoo/headers/1416218080.jpg')
            ->setIsActive(true)
            ->setSlider($slider);
        $manager->persist($slide3);

        $slide4 = new Slide();
        $slide4->setImage('/img/sites/zoo/headers/1416218152.jpg')
            ->setImageRoot('/var/www/vhosts/multisite3/app/../web/img/sites/zoo/headers/1416218152.jpg')
            ->setIsActive(true)
            ->setSlider($slider);
        $manager->persist($slide4);

        $slide5 = new Slide();
        $slide5->setImage('/img/sites/zoo/headers/1416218888.jpg')
            ->setImageRoot('/var/www/vhosts/multisite3/app/../web/img/sites/zoo/headers/1416218888.jpg')
            ->setIsActive(true)
            ->setSlider($slider);
        $manager->persist($slide5);

        $slide6 = new Slide();
        $slide6->setImage('/img/sites/zoo/headers/1416219002.jpg')
            ->setImageRoot('/var/www/vhosts/multisite3/app/../web/img/sites/zoo/headers/1416219002.jpg')
            ->setIsActive(true)
            ->setSlider($slider);
        $manager->persist($slide6);

        $manager->flush();

        $this->setReference('zpb-slide-1',$slide1);
        $this->setReference('zpb-slide-2',$slide2);
        $this->setReference('zpb-slide-3',$slide3);
        $this->setReference('zpb-slide-4',$slide4);
        $this->setReference('zpb-slide-5',$slide5);
        $this->setReference('zpb-slide-6',$slide6);

    }
    
    public function getOrder()
    {
        return 410;
    }
}

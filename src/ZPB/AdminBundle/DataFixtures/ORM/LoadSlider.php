<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 17/11/2014
 * Time: 11:27
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
use ZPB\AdminBundle\Entity\Slider;

class LoadSlider extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $slider = new Slider();
        $slider->setInstitution('zoo');

        $manager->persist($slider);

        $slider2 = new Slider();
        $slider2->setInstitution('bn');

        $manager->persist($slider2);

        $manager->flush();

        $this->setReference('zpb-slider-zoo', $slider);
        $this->setReference('zpb-slider-zoo-2', $slider2);
    }
    
    public function getOrder()
    {
        return 400;
    }
}

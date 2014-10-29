<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 29/10/2014
 * Time: 09:21
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
use ZPB\AdminBundle\Entity\AnimationDay;

class LoadAnimationDay extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $ad1 = new AnimationDay();
        $ad1->setName('Zone 1 type 1')->setColor('#6465C7');
        $manager->persist($ad1);

        $ad2 = new AnimationDay();
        $ad2->setName('Zone 1 type 2')->setColor('#3EBC77');
        $manager->persist($ad2);

        $ad3 = new AnimationDay();
        $ad3->setName('Zone 2 type 1')->setColor('#B73A1D');
        $manager->persist($ad3);

        $ad4 = new AnimationDay();
        $ad4->setName('Zone 2 type 2')->setColor('#B71DA8');
        $manager->persist($ad4);

        $manager->flush();

        $this->addReference('zpb-anim-day-1', $ad1);
        $this->addReference('zpb-anim-day-2', $ad2);
        $this->addReference('zpb-anim-day-3', $ad3);
        $this->addReference('zpb-anim-day-4', $ad4);



    }
    
    public function getOrder()
    {
        return 61;
    }
}

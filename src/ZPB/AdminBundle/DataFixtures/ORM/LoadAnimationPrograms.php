<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 29/10/2014
 * Time: 10:07
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
use ZPB\AdminBundle\Entity\AnimationProgram;

class LoadAnimationPrograms extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $ap1 = new AnimationProgram();
        $ap1->setDaytime($this->getTime('27/10'));
        $ap1->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap1->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $manager->persist($ap1);


        $ap2 = new AnimationProgram();
        $ap2->setDaytime($this->getTime('28/10'));
        $ap2->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap2->addAnimationDay($this->getReference('zpb-anim-day-3'));
        $manager->persist($ap2);

        $ap3 = new AnimationProgram();
        $ap3->setDaytime($this->getTime('29/10'));
        $ap3->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap3->addAnimationDay($this->getReference('zpb-anim-day-3'));
        $manager->persist($ap3);


        $ap4 = new AnimationProgram();
        $ap4->setDaytime($this->getTime('30/10'));
        $ap4->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $ap4->addAnimationDay($this->getReference('zpb-anim-day-4'));
        $manager->persist($ap4);


        $ap5 = new AnimationProgram();
        $ap5->setDaytime($this->getTime('31/10'));
        $ap5->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $ap5->addAnimationDay($this->getReference('zpb-anim-day-4'));
        $manager->persist($ap5);


        $ap6 = new AnimationProgram();
        $ap6->setDaytime($this->getTime('1/11'));
        $ap6->addAnimationDay($this->getReference('zpb-anim-day-3'));
        $ap6->addAnimationDay($this->getReference('zpb-anim-day-4'));
        $manager->persist($ap6);

        $ap7 = new AnimationProgram();
        $ap7->setDaytime($this->getTime('2/11'));
        $ap7->addAnimationDay($this->getReference('zpb-anim-day-3'));
        $ap7->addAnimationDay($this->getReference('zpb-anim-day-4'));
        $manager->persist($ap7);


        $ap8 = new AnimationProgram();
        $ap8->setDaytime($this->getTime('3/11'));
        $ap8->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap8->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $manager->persist($ap8);


        $ap9 = new AnimationProgram();
        $ap9->setDaytime($this->getTime('4/11'));
        $ap9->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap9->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $manager->persist($ap9);


        $ap10 = new AnimationProgram();
        $ap10->setDaytime($this->getTime('5/11'));
        $ap10->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap10->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $manager->persist($ap10);

        $ap11 = new AnimationProgram();
        $ap11->setDaytime($this->getTime('6/11'));
        $ap11->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap11->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $manager->persist($ap11);


        $ap12 = new AnimationProgram();
        $ap12->setDaytime($this->getTime('7/11'));
        $ap12->addAnimationDay($this->getReference('zpb-anim-day-1'));
        $ap12->addAnimationDay($this->getReference('zpb-anim-day-2'));
        $manager->persist($ap12);


        $manager->flush();

        $this->addReference('zpb-anim-prog-1',$ap1);
        $this->addReference('zpb-anim-prog-2',$ap2);
        $this->addReference('zpb-anim-prog-3',$ap3);
        $this->addReference('zpb-anim-prog-4',$ap4);
        $this->addReference('zpb-anim-prog-5',$ap5);
        $this->addReference('zpb-anim-prog-6',$ap6);
        $this->addReference('zpb-anim-prog-7',$ap7);
        $this->addReference('zpb-anim-prog-8',$ap8);
        $this->addReference('zpb-anim-prog-9',$ap9);
        $this->addReference('zpb-anim-prog-10',$ap10);
        $this->addReference('zpb-anim-prog-11',$ap11);
        $this->addReference('zpb-anim-prog-12',$ap12);




    }

    private function getTime($time)
    {
        return \DateTime::createFromFormat('d/m/y', $time . '/14');
    }
    
    public function getOrder()
    {
        return 63;
    }
}

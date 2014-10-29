<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 29/10/2014
 * Time: 09:14
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
use ZPB\AdminBundle\Entity\AnimationSchedule;

class LoadAnimationSchedules extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $as1 = new AnimationSchedule();
        $as1->setAnimation($this->getReference('zpb-anim-1'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('09:30'));
        $manager->persist($as1);

        $as2 = new AnimationSchedule();
        $as2->setAnimation($this->getReference('zpb-anim-2'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('10:00'));
        $manager->persist($as2);

        $as3 = new AnimationSchedule();
        $as3->setAnimation($this->getReference('zpb-anim-3'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('10:30'));
        $manager->persist($as3);

        $as4 = new AnimationSchedule();
        $as4->setAnimation($this->getReference('zpb-anim-4'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('11:00'));
        $manager->persist($as4);

        $as5 = new AnimationSchedule();
        $as5->setAnimation($this->getReference('zpb-anim-5'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('11:30'));
        $manager->persist($as5);

        $as6 = new AnimationSchedule();
        $as6->setAnimation($this->getReference('zpb-anim-6'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('12:00'));
        $manager->persist($as6);


        $as7 = new AnimationSchedule();
        $as7->setAnimation($this->getReference('zpb-anim-7'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('12:30'));
        $manager->persist($as7);

        $as8 = new AnimationSchedule();
        $as8->setAnimation($this->getReference('zpb-anim-8'))
            ->setAnimationDay($this->getReference('zpb-anim-day-1'))
            ->setTimetable($this->getTime('13:00'));
        $manager->persist($as8);

        //////////////////////////////////

        $as9 = new AnimationSchedule();
        $as9->setAnimation($this->getReference('zpb-anim-8'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('10:30'));
        $manager->persist($as9);

        $as10 = new AnimationSchedule();
        $as10->setAnimation($this->getReference('zpb-anim-7'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('11:00'));
        $manager->persist($as10);

        $as11 = new AnimationSchedule();
        $as11->setAnimation($this->getReference('zpb-anim-6'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('12:30'));
        $manager->persist($as11);

        $as12 = new AnimationSchedule();
        $as12->setAnimation($this->getReference('zpb-anim-5'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('13:00'));
        $manager->persist($as12);

        $as13 = new AnimationSchedule();
        $as13->setAnimation($this->getReference('zpb-anim-4'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('13:30'));
        $manager->persist($as13);

        $as14 = new AnimationSchedule();
        $as14->setAnimation($this->getReference('zpb-anim-3'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('14:00'));
        $manager->persist($as14);


        $as15 = new AnimationSchedule();
        $as15->setAnimation($this->getReference('zpb-anim-2'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('14:30'));
        $manager->persist($as15);

        $as16 = new AnimationSchedule();
        $as16->setAnimation($this->getReference('zpb-anim-1'))
            ->setAnimationDay($this->getReference('zpb-anim-day-2'))
            ->setTimetable($this->getTime('15:00'));
        $manager->persist($as16);

        ////////////////////////////////////

        $as17 = new AnimationSchedule();
        $as17->setAnimation($this->getReference('zpb-anim-4'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('10:30'));
        $manager->persist($as17);

        $as18 = new AnimationSchedule();
        $as18->setAnimation($this->getReference('zpb-anim-5'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('11:00'));
        $manager->persist($as18);

        $as19 = new AnimationSchedule();
        $as19->setAnimation($this->getReference('zpb-anim-6'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('12:30'));
        $manager->persist($as19);

        $as20 = new AnimationSchedule();
        $as20->setAnimation($this->getReference('zpb-anim-7'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('13:00'));
        $manager->persist($as20);

        $as21 = new AnimationSchedule();
        $as21->setAnimation($this->getReference('zpb-anim-1'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('13:30'));
        $manager->persist($as21);

        $as22 = new AnimationSchedule();
        $as22->setAnimation($this->getReference('zpb-anim-2'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('14:00'));
        $manager->persist($as22);


        $as23 = new AnimationSchedule();
        $as23->setAnimation($this->getReference('zpb-anim-3'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('14:30'));
        $manager->persist($as23);

        $as24 = new AnimationSchedule();
        $as24->setAnimation($this->getReference('zpb-anim-8'))
            ->setAnimationDay($this->getReference('zpb-anim-day-3'))
            ->setTimetable($this->getTime('15:00'));
        $manager->persist($as24);

        ////////////////////////////////////

        $as25 = new AnimationSchedule();
        $as25->setAnimation($this->getReference('zpb-anim-6'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('13:30'));
        $manager->persist($as25);

        $as26 = new AnimationSchedule();
        $as26->setAnimation($this->getReference('zpb-anim-7'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('14:00'));
        $manager->persist($as26);

        $as27 = new AnimationSchedule();
        $as27->setAnimation($this->getReference('zpb-anim-8'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('14:30'));
        $manager->persist($as27);

        $as28 = new AnimationSchedule();
        $as28->setAnimation($this->getReference('zpb-anim-3'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('15:00'));
        $manager->persist($as28);

        $as29 = new AnimationSchedule();
        $as29->setAnimation($this->getReference('zpb-anim-4'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('15:30'));
        $manager->persist($as29);

        $as30 = new AnimationSchedule();
        $as30->setAnimation($this->getReference('zpb-anim-5'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('16:00'));
        $manager->persist($as30);


        $as31 = new AnimationSchedule();
        $as31->setAnimation($this->getReference('zpb-anim-1'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('16:30'));
        $manager->persist($as31);

        $as32 = new AnimationSchedule();
        $as32->setAnimation($this->getReference('zpb-anim-2'))
            ->setAnimationDay($this->getReference('zpb-anim-day-4'))
            ->setTimetable($this->getTime('17:00'));
        $manager->persist($as32);


        $manager->flush();

        $this->addReference('zpb-anim-sched-1', $as1);
        $this->addReference('zpb-anim-sched-2', $as2);
        $this->addReference('zpb-anim-sched-3', $as3);
        $this->addReference('zpb-anim-sched-4', $as4);
        $this->addReference('zpb-anim-sched-5', $as5);
        $this->addReference('zpb-anim-sched-6', $as6);
        $this->addReference('zpb-anim-sched-7', $as7);
        $this->addReference('zpb-anim-sched-8', $as8);
        $this->addReference('zpb-anim-sched-9', $as9);
        $this->addReference('zpb-anim-sched-10', $as10);
        $this->addReference('zpb-anim-sched-11', $as11);
        $this->addReference('zpb-anim-sched-12', $as12);
        $this->addReference('zpb-anim-sched-13', $as13);
        $this->addReference('zpb-anim-sched-14', $as14);
        $this->addReference('zpb-anim-sched-15', $as15);
        $this->addReference('zpb-anim-sched-16', $as16);
        $this->addReference('zpb-anim-sched-17', $as17);
        $this->addReference('zpb-anim-sched-18', $as18);
        $this->addReference('zpb-anim-sched-19', $as19);
        $this->addReference('zpb-anim-sched-20', $as20);
        $this->addReference('zpb-anim-sched-21', $as21);
        $this->addReference('zpb-anim-sched-22', $as22);
        $this->addReference('zpb-anim-sched-23', $as23);
        $this->addReference('zpb-anim-sched-24', $as24);
        $this->addReference('zpb-anim-sched-25', $as25);
        $this->addReference('zpb-anim-sched-26', $as26);
        $this->addReference('zpb-anim-sched-27', $as27);
        $this->addReference('zpb-anim-sched-28', $as28);
        $this->addReference('zpb-anim-sched-29', $as29);
        $this->addReference('zpb-anim-sched-30', $as30);
        $this->addReference('zpb-anim-sched-31', $as31);
        $this->addReference('zpb-anim-sched-32', $as32);
    }
    
    public function getOrder()
    {
        return 62;
    }

    private function getTime($time)
    {
        return \DateTime::createFromFormat('H:i:s', $time . ':00');
    }
}

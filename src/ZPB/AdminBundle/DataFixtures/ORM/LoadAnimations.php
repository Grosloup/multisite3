<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 02/09/14
 * Time: 17:02
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
use ZPB\AdminBundle\Entity\Animation;

class LoadAnimations extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $anim1 = new Animation();
        $anim1->setName('Pandas')->setPlaceNumber('54');
        $manager->persist($anim1);

        $anim2 = new Animation();
        $anim2->setName('Manchots')->setPlaceNumber('60');
        $manager->persist($anim2);

        $anim3 = new Animation();
        $anim3->setName('Fauves')->setPlaceNumber('32');
        $manager->persist($anim3);

        $anim4 = new Animation();
        $anim4->setName('Eléphants')->setPlaceNumber('18');
        $manager->persist($anim4);

        $anim5 = new Animation();
        $anim5->setName('Gorilles')->setPlaceNumber('38');
        $manager->persist($anim5);

        $anim6 = new Animation();
        $anim6->setName('Girafes')->setPlaceNumber('21');
        $manager->persist($anim6);

        $anim7 = new Animation();
        $anim7->setName('Ratons laveurs')->setPlaceNumber('34');
        $manager->persist($anim7);

        $anim8 = new Animation();
        $anim8->setName('Rhinocéros indiens')->setPlaceNumber('57');
        $manager->persist($anim8);
        
        $manager->flush();
        
        $this->addReference('zpb-anim-1', $anim1);
        $this->addReference('zpb-anim-2', $anim2);
        $this->addReference('zpb-anim-3', $anim3);
        $this->addReference('zpb-anim-4', $anim4);
        $this->addReference('zpb-anim-5', $anim5);
        $this->addReference('zpb-anim-6', $anim6);
        $this->addReference('zpb-anim-7', $anim7);
        $this->addReference('zpb-anim-8', $anim8);

    }
    
    public function getOrder()
    {
        return 60;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 31/08/2014
 * Time: 22:21
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
use ZPB\AdminBundle\Entity\Institution;

class LoadInstitutions extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $inst1 = new Institution();
        $inst1->setName('ZooParc de Beauval');
        $manager->persist($inst1);

        $inst2 = new Institution();
        $inst2->setName('Les Jardins de Beauval');
        $manager->persist($inst2);

        $inst3 = new Institution();
        $inst3->setName('Les Pagodes de Beauval');
        $manager->persist($inst3);

        $inst4 = new Institution();
        $inst4->setName('Les Hameaux de Beauval');
        $manager->persist($inst4);

        $manager->flush();

        $this->addReference('zpb-instit-1', $inst1);
        $this->addReference('zpb-instit-2', $inst2);
        $this->addReference('zpb-instit-3', $inst3);
        $this->addReference('zpb-instit-4', $inst4);
    }

    public function getOrder()
    {
        return 10;
    }
}

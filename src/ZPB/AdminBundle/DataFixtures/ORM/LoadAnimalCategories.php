<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 10:55
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
use ZPB\AdminBundle\Entity\AnimalCategory;

class LoadAnimalCategories extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $c1 = new AnimalCategory();
        $c1->setName("Primates");
        $manager->persist($c1);

        $c2 = new AnimalCategory();
        $c2->setName("Carnivores");
        $manager->persist($c2);

        $c3 = new AnimalCategory();
        $c3->setName("Oiseaux");
        $manager->persist($c3);

        $c4 = new AnimalCategory();
        $c4->setName("Reptiles");
        $manager->persist($c4);

        $c5 = new AnimalCategory();
        $c5->setName("Herbivores");
        $manager->persist($c5);

        $manager->flush();

        $this->addReference('zpb-animal-cat-1', $c1);
        $this->addReference('zpb-animal-cat-2', $c2);
        $this->addReference('zpb-animal-cat-3', $c3);
        $this->addReference('zpb-animal-cat-4', $c4);
        $this->addReference('zpb-animal-cat-5', $c5);
    }

    public function getOrder()
    {
        return 29;
    }
}

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
        $inst1->setName('ZooParc de Beauval')
        ->setDescription('Fusce luctus mollis arcu sed pretium. Phasellus porta non diam ac varius. Maecenas vel posuere tellus. In efficitur fringilla libero, ac pretium lacus ultrices a. In id metus eu sem semper molestie sed facilisis metus. Curabitur varius libero a odio malesuada, vel condimentum ante sagittis.')
        ->setHost('new.zoobeauval.com');
        $manager->persist($inst1);

        $inst2 = new Institution();
        $inst2->setName('Les Jardins de Beauval')
        ->setDescription('Cras id libero iaculis, sodales magna sed, blandit dui. Suspendisse eleifend nibh aliquam elit suscipit, sed malesuada erat consequat. Donec aliquet libero eget maximus gravida. ')
        ->setHost('new.lesjardinsdebeauval.com');
        $manager->persist($inst2);

        $inst3 = new Institution();
        $inst3->setName('Les Pagodes de Beauval')
        ->setDescription('Sed tincidunt massa lobortis vehicula pretium. Integer justo justo, interdum in nulla vitae, convallis fringilla lorem. Pellentesque porttitor dapibus nisi eu suscipit. Maecenas ipsum justo, fringilla eget ipsum vitae, mollis facilisis nunc.')
        ->setHost('new.lespagodesdebeauval.com');
        $manager->persist($inst3);

        $inst4 = new Institution();
        $inst4->setName('Les Hameaux de Beauval')
        ->setDescription('Suspendisse fermentum malesuada feugiat. Etiam volutpat porta orci, quis mollis sem viverra in. In ultricies vulputate ipsum et tincidunt. Maecenas nisl felis, feugiat sit amet rutrum eget, fringilla non ipsum. ')
        ->setHost('new.leshameauxbeauval.com');
        $manager->persist($inst4);


        $inst5 = new Institution();
        $inst5->setName('Groupes Enfants')
            ->setDescription('Suspendisse fermentum malesuada feugiat. Etiam volutpat porta orci, quis mollis sem viverra in. In ultricies vulputate ipsum et tincidunt. Maecenas nisl felis, feugiat sit amet rutrum eget, fringilla non ipsum. ')
            ->setHost('new.scolaires.zoobeauval.com');
        $manager->persist($inst5);

        $inst6 = new Institution();
        $inst6->setName('Groupes')
            ->setDescription('Suspendisse fermentum malesuada feugiat. Etiam volutpat porta orci, quis mollis sem viverra in. In ultricies vulputate ipsum et tincidunt. Maecenas nisl felis, feugiat sit amet rutrum eget, fringilla non ipsum. ')
            ->setHost('new.groupes.zoobeauval.com');
        $manager->persist($inst6);

        $inst7 = new Institution();
        $inst7->setName('Professionnels')
            ->setDescription('Suspendisse fermentum malesuada feugiat. Etiam volutpat porta orci, quis mollis sem viverra in. In ultricies vulputate ipsum et tincidunt. Maecenas nisl felis, feugiat sit amet rutrum eget, fringilla non ipsum. ')
            ->setHost('new.pro.zoobeauval.com');
        $manager->persist($inst7);

        $inst8 = new Institution();
        $inst8->setName('Comités d\'Entreprises')
            ->setDescription('Suspendisse fermentum malesuada feugiat. Etiam volutpat porta orci, quis mollis sem viverra in. In ultricies vulputate ipsum et tincidunt. Maecenas nisl felis, feugiat sit amet rutrum eget, fringilla non ipsum. ')
            ->setHost('new.ce.zoobeauval.com');
        $manager->persist($inst8);

        $inst9 = new Institution();
        $inst9->setName('Commune')
            ->setDescription('Suspendisse fermentum malesuada feugiat. Etiam volutpat porta orci, quis mollis sem viverra in. In ultricies vulputate ipsum et tincidunt. Maecenas nisl felis, feugiat sit amet rutrum eget, fringilla non ipsum. ');

        $manager->persist($inst9);

        $manager->flush();

        $this->addReference('zpb-instit-1', $inst1);
        $this->addReference('zpb-instit-2', $inst2);
        $this->addReference('zpb-instit-3', $inst3);
        $this->addReference('zpb-instit-4', $inst4);
        $this->addReference('zpb-instit-5', $inst5);
        $this->addReference('zpb-instit-6', $inst6);
        $this->addReference('zpb-instit-7', $inst7);
        $this->addReference('zpb-instit-8', $inst8);
        $this->addReference('zpb-instit-9', $inst9);
    }

    public function getOrder()
    {
        return 10;
    }
}

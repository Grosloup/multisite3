<?php ?>
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 09:26
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
use ZPB\AdminBundle\Entity\PostTarget;

/**
 * Class LoadPostTargets
 * @package
 */
class LoadPostTargets  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $pt1 = new PostTarget();
        $pt1->setName('ZooParc de Beauval');
        $manager->persist($pt1);
        $pt2 = new PostTarget();
        $pt2->setName('Les Jardins de Beauval');
        $manager->persist($pt2);
        $pt3 = new PostTarget();
        $pt3->setName('Les Pagodes de Beauval');
        $manager->persist($pt3);
        $pt4 = new PostTarget();
        $pt4->setName('Les Hameaux de Beauval');
        $manager->persist($pt4);
        $pt5 = new PostTarget();
        $pt5->setName('Beauval Nature');
        $manager->persist($pt5);

        $pt6 = new PostTarget();
        $pt6->setName('Professionnels');
        $manager->persist($pt6);

        $pt7 = new PostTarget();
        $pt7->setName('Scolaires');
        $manager->persist($pt7);

        $pt8 = new PostTarget();
        $pt8->setName('Groupes');
        $manager->persist($pt8);

        $pt9 = new PostTarget();
        $pt9->setName('Comités d\'Entreprises');
        $manager->persist($pt9);

        $manager->flush();


        $this->addReference('zpb-news-pt-1',$pt1);
        $this->addReference('zpb-news-pt-2',$pt2);
        $this->addReference('zpb-news-pt-3',$pt3);
        $this->addReference('zpb-news-pt-4',$pt4);
        $this->addReference('zpb-news-pt-5',$pt5);
        $this->addReference('zpb-news-pt-6',$pt6);
        $this->addReference('zpb-news-pt-7',$pt7);
        $this->addReference('zpb-news-pt-8',$pt8);
        $this->addReference('zpb-news-pt-9',$pt9);
    }

    public function getOrder()
    {
        return 20;
    }
}

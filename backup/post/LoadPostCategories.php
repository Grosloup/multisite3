<?php ?>
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 10:25
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
use ZPB\AdminBundle\Entity\PostCategory;

/**
 * Class LoadPostCategories
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPostCategories  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $cat1 = new PostCategory();
        $cat1->setName('Nouveauté');
        $manager->persist($cat1);
        $cat2 = new PostCategory();
        $cat2->setName('Carnet rose');
        $manager->persist($cat2);
        $cat3 = new PostCategory();
        $cat3->setName('Animal vedette');
        $manager->persist($cat3);
        $cat4 = new PostCategory();
        $cat4->setName('Soirée');
        $manager->persist($cat4);
        $cat5 = new PostCategory();
        $cat5->setName('Repas festif');
        $manager->persist($cat5);

        $manager->flush();

        $this->addReference('zpb-post-cat-1', $cat1);
        $this->addReference('zpb-post-cat-2', $cat2);
        $this->addReference('zpb-post-cat-3', $cat3);
        $this->addReference('zpb-post-cat-4', $cat4);
        $this->addReference('zpb-post-cat-5', $cat5);
    }

    public function getOrder()
    {
        return 21;
    }
}

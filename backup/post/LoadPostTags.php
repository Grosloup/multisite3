<?php ?>
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 10:32
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
use ZPB\AdminBundle\Entity\PostTag;

/**
 * Class LoadPostTags
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPostTags  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $tag1 = new PostTag();
        $tag1->setName('Bébé');
        $manager->persist($tag1);
        $tag2 = new PostTag();
        $tag2->setName('Gorille');
        $manager->persist($tag2);
        $tag3 = new PostTag();
        $tag3->setName('Noël');
        $manager->persist($tag3);
        $tag4 = new PostTag();
        $tag4->setName('Promo');
        $manager->persist($tag4);

        $manager->flush();

        $this->addReference('zpb-post-tag-1', $tag1);
        $this->addReference('zpb-post-tag-2', $tag2);
        $this->addReference('zpb-post-tag-3', $tag3);
        $this->addReference('zpb-post-tag-4', $tag4);
    }

    public function getOrder()
    {
        return 22;
    }
}

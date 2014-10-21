<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 22/10/2014
 * Time: 00:23
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
        $tag1->setName('tag 1 zoo')->setTarget('zoo');
        $manager->persist($tag1);

        $tag2 = new PostTag();
        $tag2->setName('tag 2 zoo')->setTarget('zoo');
        $manager->persist($tag2);

        $tag3 = new PostTag();
        $tag3->setName('tag 3 zoo')->setTarget('zoo');
        $manager->persist($tag3);

        $tag4 = new PostTag();
        $tag4->setName('tag 4 bn')->setTarget('bn');
        $manager->persist($tag4);

        $tag5 = new PostTag();
        $tag5->setName('tag 5 bn')->setTarget('bn');
        $manager->persist($tag5);

        $tag6 = new PostTag();
        $tag6->setName('tag 6 bn')->setTarget('bn');
        $manager->persist($tag6);

        $tag7 = new PostTag();
        $tag7->setName('tag 7 jdb')->setTarget('jdb');
        $manager->persist($tag7);

        $tag8 = new PostTag();
        $tag8->setName('tag 8 jdb')->setTarget('jdb');
        $manager->persist($tag8);

        $tag9 = new PostTag();
        $tag9->setName('tag 9 jdb')->setTarget('jdb');
        $manager->persist($tag9);

        $tag10 = new PostTag();
        $tag10->setName('tag 10 hdb')->setTarget('hdb');
        $manager->persist($tag10);

        $tag11 = new PostTag();
        $tag11->setName('tag 11 hdb')->setTarget('hdb');
        $manager->persist($tag11);

        $tag12 = new PostTag();
        $tag12->setName('tag 12 hdb')->setTarget('hdb');
        $manager->persist($tag12);

        $tag13 = new PostTag();
        $tag13->setName('tag 13 pdb')->setTarget('pdb');
        $manager->persist($tag13);

        $tag14 = new PostTag();
        $tag14->setName('tag 14 pdb')->setTarget('pdb');
        $manager->persist($tag14);

        $tag15 = new PostTag();
        $tag15->setName('tag 15 pdb')->setTarget('pdb');
        $manager->persist($tag15);


        $manager->flush();

        $this->addReference('zpb-post-tag-zoo-1', $tag1);
        $this->addReference('zpb-post-tag-zoo-2', $tag2);
        $this->addReference('zpb-post-tag-zoo-3', $tag3);

        $this->addReference('zpb-post-tag-bn-4', $tag4);
        $this->addReference('zpb-post-tag-bn-5', $tag5);
        $this->addReference('zpb-post-tag-bn-6', $tag6);

        $this->addReference('zpb-post-tag-jdb-7', $tag7);
        $this->addReference('zpb-post-tag-jdb-8', $tag8);
        $this->addReference('zpb-post-tag-jdb-9', $tag9);

        $this->addReference('zpb-post-tag-hdb-10', $tag10);
        $this->addReference('zpb-post-tag-hdb-11', $tag11);
        $this->addReference('zpb-post-tag-hdb-12', $tag12);

        $this->addReference('zpb-post-tag-pdb-13', $tag13);
        $this->addReference('zpb-post-tag-pdb-14', $tag14);
        $this->addReference('zpb-post-tag-pdb-15', $tag15);
    }

    public function getOrder()
    {
        return 22;
    }
}

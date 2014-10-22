<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 22/10/2014
 * Time: 00:09
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
 * @package ZPB\AdminBundle\Datafixtures\ORM
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
        $cat1->setName('categorie 1 zoo')->setTarget('zoo');
        $manager->persist($cat1);

        $cat2 = new PostCategory();
        $cat2->setName('categorie 2 zoo')->setTarget('zoo');
        $manager->persist($cat2);

        $cat3 = new PostCategory();
        $cat3->setName('categorie 3 zoo')->setTarget('zoo');
        $manager->persist($cat3);

        $cat4 = new PostCategory();
        $cat4->setName('categorie 4 bn')->setTarget('bn');
        $manager->persist($cat4);

        $cat5 = new PostCategory();
        $cat5->setName('categorie 5 bn')->setTarget('bn');
        $manager->persist($cat5);

        $cat6 = new PostCategory();
        $cat6->setName('categorie 6 bn')->setTarget('bn');
        $manager->persist($cat6);

        $cat7 = new PostCategory();
        $cat7->setName('categorie 7 jdb')->setTarget('jdb');
        $manager->persist($cat7);

        $cat8 = new PostCategory();
        $cat8->setName('categorie 8 jdb')->setTarget('jdb');
        $manager->persist($cat8);

        $cat9 = new PostCategory();
        $cat9->setName('categorie 9 jdb')->setTarget('jdb');
        $manager->persist($cat9);

        $cat10 = new PostCategory();
        $cat10->setName('categorie 10 hdb')->setTarget('hdb');
        $manager->persist($cat10);

        $cat11 = new PostCategory();
        $cat11->setName('categorie 11 hdb')->setTarget('hdb');
        $manager->persist($cat11);

        $cat12 = new PostCategory();
        $cat12->setName('categorie 12 hdb')->setTarget('hdb');
        $manager->persist($cat12);

        $cat13 = new PostCategory();
        $cat13->setName('categorie 13 pdb')->setTarget('pdb');
        $manager->persist($cat13);

        $cat14 = new PostCategory();
        $cat14->setName('categorie 14 pdb')->setTarget('pdb');
        $manager->persist($cat14);

        $cat15 = new PostCategory();
        $cat15->setName('categorie 15 pdb')->setTarget('pdb');
        $manager->persist($cat15);


        $manager->flush();

        $this->addReference('zpb-post-cat-zoo-1', $cat1);
        $this->addReference('zpb-post-cat-zoo-2', $cat2);
        $this->addReference('zpb-post-cat-zoo-3', $cat3);

        $this->addReference('zpb-post-cat-bn-4', $cat4);
        $this->addReference('zpb-post-cat-bn-5', $cat5);
        $this->addReference('zpb-post-cat-bn-6', $cat6);

        $this->addReference('zpb-post-cat-jdb-7', $cat7);
        $this->addReference('zpb-post-cat-jdb-8', $cat8);
        $this->addReference('zpb-post-cat-jdb-9', $cat9);

        $this->addReference('zpb-post-cat-hdb-10', $cat10);
        $this->addReference('zpb-post-cat-hdb-11', $cat11);
        $this->addReference('zpb-post-cat-hdb-12', $cat12);

        $this->addReference('zpb-post-cat-pdb-13', $cat13);
        $this->addReference('zpb-post-cat-pdb-14', $cat14);
        $this->addReference('zpb-post-cat-pdb-15', $cat15);

    }

    public function getOrder()
    {
        return 21;
    }
}

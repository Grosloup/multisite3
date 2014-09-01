<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 31/08/2014
 * Time: 22:31
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
use ZPB\AdminBundle\Entity\PhotoCategory;

// use ZPB\AdminBundle\Entity\PhotoCategory;

class LoadPhotoCategories  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $pc1 = new PhotoCategory();
        $pc1->setName('Nouveauté');
        $pc1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisl ligula, ornare sit amet pharetra id, mollis eget est. Nullam quis lorem id diam blandit accumsan facilisis vitae nibh. Quisque aliquam suscipit sapien ut egestas. Nulla at semper orci, vitae volutpat odio. Nulla facilisi.');
        $manager->persist($pc1);
        $pc2 = new PhotoCategory();
        $pc2->setName('Carnet rose');
        $pc2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisl ligula, ornare sit amet pharetra id, mollis eget est. Nullam quis lorem id diam blandit accumsan facilisis vitae nibh. Quisque aliquam suscipit sapien ut egestas. Nulla at semper orci, vitae volutpat odio. Nulla facilisi.');
        $manager->persist($pc2);
        $pc3 = new PhotoCategory();
        $pc3->setName('Chambres (JdB)');
        $pc3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisl ligula, ornare sit amet pharetra id, mollis eget est. Nullam quis lorem id diam blandit accumsan facilisis vitae nibh. Quisque aliquam suscipit sapien ut egestas. Nulla at semper orci, vitae volutpat odio. Nulla facilisi.');
        $manager->persist($pc3);
        $pc4 = new PhotoCategory();
        $pc4->setName('Chambres (HdB)');
        $pc4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisl ligula, ornare sit amet pharetra id, mollis eget est. Nullam quis lorem id diam blandit accumsan facilisis vitae nibh. Quisque aliquam suscipit sapien ut egestas. Nulla at semper orci, vitae volutpat odio. Nulla facilisi.');
        $manager->persist($pc4);
        $manager->flush();

        $this->addReference('zpb-photo-cat-1', $pc1);
        $this->addReference('zpb-photo-cat-2', $pc2);
        $this->addReference('zpb-photo-cat-3', $pc3);
        $this->addReference('zpb-photo-cat-4', $pc4);
    }

    public function getOrder()
    {
        return 15;
    }
}

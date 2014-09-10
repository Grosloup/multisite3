<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/09/2014
 * Time: 19:45
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
use ZPB\AdminBundle\Entity\PageStatic;

/**
 * Class LoadStaticPages
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadStaticPages  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $sp1  = new PageStatic();
        $sp1->setName('homepage')->setTitle('Accueil')->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et arcu est. Duis quis rhoncus mi. Maecenas a suscipit eros, sed tristique risus. Fusce faucibus vulputate lorem, ac volutpat nulla accumsan sit amet. Donec ut volutpat velit. Aenean feugiat ornare enim, ut fermentum dui blandit eget.')->setKeywords('Lorem, ipsum, dolor, sit, amet, consectetur, adipiscing, elit')->setRouteName('zpb_sites_zoo_homepage')->setOwner($this->getReference('zpb-news-pt-1'));
        $manager->persist($sp1);

        $sp2  = new PageStatic();
        $sp2->setName('faq homepage')->setTitle('FAQ')->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et arcu est. Duis quis rhoncus mi. Maecenas a suscipit eros, sed tristique risus. Fusce faucibus vulputate lorem, ac volutpat nulla accumsan sit amet. Donec ut volutpat velit. Aenean feugiat ornare enim, ut fermentum dui blandit eget.')->setKeywords('Lorem, ipsum, dolor, sit, amet, consectetur, adipiscing, elit')->setRouteName('zpb_sites_zoo_faq')->setOwner($this->getReference('zpb-news-pt-1'));
        $manager->persist($sp2);

        $sp3  = new PageStatic();
        $sp3->setName('parrainage homepage')->setTitle('Parrainez un animal')->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et arcu est. Duis quis rhoncus mi. Maecenas a suscipit eros, sed tristique risus. Fusce faucibus vulputate lorem, ac volutpat nulla accumsan sit amet. Donec ut volutpat velit. Aenean feugiat ornare enim, ut fermentum dui blandit eget.')->setKeywords('Lorem, ipsum, dolor, sit, amet, consectetur, adipiscing, elit')->setRouteName('zpb_sites_zoo_parrainages_homepage')->setOwner($this->getReference('zpb-news-pt-1'));
        $manager->persist($sp3);



        $sp4  = new PageStatic();
        $sp4->setName('parrainage animal description')->setTitle('Parrainez un animal')->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et arcu est. Duis quis rhoncus mi. Maecenas a suscipit eros, sed tristique risus. Fusce faucibus vulputate lorem, ac volutpat nulla accumsan sit amet. Donec ut volutpat velit. Aenean feugiat ornare enim, ut fermentum dui blandit eget.')->setKeywords('Lorem, ipsum, dolor, sit, amet, consectetur, adipiscing, elit')->setRouteName('zpb_sites_zoo_parrainages_animal_show')->setOwner($this->getReference('zpb-news-pt-1'));
        $manager->persist($sp4);





        $manager->flush();

        $this->addReference('zpb-static-page-1', $sp1);
        $this->addReference('zpb-static-page-2', $sp2);
        $this->addReference('zpb-static-page-3', $sp3);
        $this->addReference('zpb-static-page-4', $sp4);
    }

    public function getOrder()
    {
        return 200;
    }
}

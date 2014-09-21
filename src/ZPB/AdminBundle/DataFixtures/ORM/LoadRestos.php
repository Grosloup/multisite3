<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 13:59
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
use ZPB\AdminBundle\Entity\Restaurant;

/**
 * Class LoadRestos
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadRestos  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $names = [
            "Self-service Le Tropical",
            "Restaurant Le Kilimandjaro",
            "Crêperie La Roseraie",
            "L'Eucalyptus",
            "La Pagode",
            "La Savane",
            "Les Orangs-outans",
            "Les Lamantins",
            "Les Chats Pêcheurs",
            "Les Chalets"
        ];
        $descs = [
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "Vivamus sollicitudin, justo vitae tincidunt fermentum, dui lorem egestas lectus, sed volutpat tortor diam nec mauris.",
            "Praesent et metus a nunc hendrerit tristique sit amet sit amet nulla.",
            "Sed nec mauris ut ipsum maximus facilisis eu id neque.",
            "Cras pretium nisl in ipsum malesuada, ac accumsan tellus imperdiet.",
            "Nunc rutrum, turpis a faucibus facilisis, erat leo consectetur odio, quis pretium odio leo in nibh.",
            "Vivamus feugiat fringilla elit, at volutpat massa. Proin egestas, ante sit amet consequat egestas, lorem libero vestibulum neque, eu cursus tortor metus id mauris.",
            "Donec congue nunc nec lacus sodales, at semper quam rutrum.",
            "Nulla ac lacus eu turpis varius vulputate.",
            "Praesent ut gravida mi. Donec blandit elementum massa, eleifend hendrerit massa eleifend vel."
        ];
        for($i=0;$i<10;$i++){
            $resto = new Restaurant();
            $k = $i+1;
            $resto->setName($names[$i])->setDescription($descs[$i])->setMapNum($k)->setVisuel($this->getReference('zpb-image-' . $k));
            $manager->persist($resto);
            $this->addReference('zpb-resto-' . $k, $resto);
        }
        $manager->flush();


    }

    public function getOrder()
    {
        return 250;
    }
}

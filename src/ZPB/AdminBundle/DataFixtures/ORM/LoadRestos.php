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
            "Le Tropical",
            "Le Kilimandjaro",
            "La Roseraie",
            "L'Eucalyptus",
            "La Pagode",
            "La Savane",
            "Les Orangs-outans",
            "Les Lamantins",
            "Les Chats Pêcheurs"
        ];
        $descs = [
            "Au carrefour de nombreuses allées du ZooParc, Le Tropical propose <strong>entrées</strong>,<strong> plats chauds, desserts, glaces et boissons</strong>. Vous pouvez profiter d'une vue panoramique sur la piscine des otaries (premier étage) ou bien préférer les terrasses extérieures qui donnent sur le cours d’eau et  ses îles investies par macaques et atèles. Un lieu d'accueil idéal pour les groupes.",
            "Un restaurant à vision panoramique portant le nom du célèbre sommet tanzanien, \"Le Kilimandjaro\", domine l'aire du spectacle d'oiseaux. <strong>Au menu&nbsp;: hamburgers, steaks frites, nuggets, salades</strong> Pour allier plaisirs des yeux et des papilles&nbsp;!",
            "Une terrasse recouverte de roses,  face aux tigres blancs et surplombant l’un des plans d’eau du ZooParc. Appréciées des visiteurs, <strong>les galettes et les crêpes</strong> de Beauval sont à déguster au déjeuner comme au goûter&nbsp;! Vous y trouverez également <strong>sandwichs, salades, glaces et boissons.</strong>",
            "Une pause adorée des enfants&nbsp;: près d'une grande aire de jeux,  un magnifique carrousel leur est proposé. Pendant un moment de détente sur la terrasse ombragée, vos enfants seront heureux de chevaucher un lion ou une girafe. <strong>Sandwichs, pizzas, croque-monsieur, salades, glaces et boissons.</strong>",
            "Restauration à la chinoise&nbsp;? Prenez du temps sur les Hauteurs de Chine et dégustez <strong>nems, beignets de crevettes et thé au jasmin</strong> (mais aussi pizzas plus classiques) dans un décor chinois à couper le souffle&nbsp;!",
            "Prenez votre petit-déjeuner en observant les girafes. Faites une pause déjeuner en suivant des yeux les rhinocéros, les bonds des springboks ou la course des autruches… En bordure de la savane, ce point de restauration vous propose <strong>sandwichs, hot-dogs, glaces et boissons.</strong>",
            "Devant l’île des orangs-outans, une terrasse ombragée vous permet de consommer en toute tranquillité <strong>plats chauds, salades, pizzas, glaces et boissons.</strong>",
            "À la sortie de la serre tropicale des lamantins, découvrez un petit coin à part où vous pouvez acheter<strong> glaces, boissons et granités</strong>. Quelques tables, avec vue sur l’île des gorilles, vous offrent un repos agréable.",
            "Un point de restauration rapide près de la nouvelle plaine asiatique. Déjeunez  rapidement et profitez pleinement de votre journée en vous promenant. <strong>Hot-dogs,  gaufres, glaces et boissons</strong> réjouiront petits et grands.",
        ];
        $c = count($names);
        for($i=0;$i<$c;$i++){
            $resto = new Restaurant();
            $k = $i+1;
            $image = $this->getReference('zpb-image-' . $k);
            $resto->setName($names[$i])->setDescription($descs[$i])->setMapNum($k)->setVisuel($image);
            $image->addInUse();
            $manager->persist($image);
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

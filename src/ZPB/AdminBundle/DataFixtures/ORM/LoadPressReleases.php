<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 23:21
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
use ZPB\AdminBundle\Entity\PressRelease;

/**
 * Class LoadPressReleases
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPressReleases  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $titles = ["Le ZooParc de Beauval classé 1er zoo de France par TripAdvisor !","450 bébés cette année dont... un lamantin !","À savourer dès la rentrée !","Nouvelle édition des JBC !"];
        $bodies = [
            "TripAdvisor, le plus grand site de voyages au monde a dévoilé hier son classement
«Travelers Choice» dédiés aux zoos et aquariums. Au total, 275 gagnants ont été désignés
(171 zoos et 104 aquariums), répartis dans le monde entier...",
            "Le ZooParc de Beauval reste le seul lieu à accueillir plusieurs <strong>lamantins</strong>,
espèce très menacée dans son environnement naturel et rarissime en France... <strong>Le 24 avril dernier, un petit mâle a vu le jour</strong>. Prénommé Mandilo, celui-ci n'a pas immédiatement réussi à téter sa mère. Retour sur une belle histoire...",
            "Durant la saison automnale et les vacances de La Toussaint / Noël, le Service Pédagogique du ZooParc de Beauval propose aux amoureux des animaux et soigneurs en herbe de vivre des matinées d'exception, aux côtés des soigneurs animaliers et de leurs protégés. Découvrez le programme \"Soigneur d'un Jour\" et sa version Junior : des heures inoubliables au milieu des animaux sauvages...",
            "<strong>Le coup d'envoi des Journées Beauval Conservation (JBC) est donné&nbsp;!</strong> Pour la seconde année consécutive, Beauval organise des évènements thématiques dédiés à la préservation de la biodiversité. Mercredi 23 avril, la journée sera consacrée au <strong>principal mécène de l'association Beauval Nature&nbsp;: l'AOP Sainte Maure de Touraine</strong>. Regroupant des producteurs respectueux de la nature et garants d'une fabrication fromagère artisanale, l'Appellation d'Origine Protégée s'associe à l'organisation d'une grande journée...<br>
  "
        ];

        for($i=0; $i<4;$i++){
            $pr = new PressRelease();
            $pr->setTitle($titles[$i]);
            $pr->setBody($bodies[$i]);
            $k = $i+1;
            $pr->setPdfFr($this->getReference('zpb-pdf-'.$k)->getFilename());
            $manager->persist($pr);
            $this->addReference('zpb-pr-' . $k, $pr);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 230;
    }
}

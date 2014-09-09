<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/09/2014
 * Time: 16:40
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
use ZPB\AdminBundle\Entity\Sponsoring;

class LoadSponsoring extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $types = $this->container->getParameter('zpb.sponsoring_type');
        $now = new \DateTime();
        $aYear = (new \DateTime())->add(new \DateInterval('P1Y'));
        $sp1 = new Sponsoring();
        $sp1->setGodparent($this->getReference('sponsor-godparent-1'));
        $this->getReference('sponsor-godparent-1')->addSponsoring($sp1);
        $sp1->setFormula($this->getReference('zpb-sponsor-sponsor-desc-1'));
        $sp1->setStartAt($now);
        $sp1->setEndAt($aYear);
        $sp1->setType($types['enligne']);
        $manager->persist($sp1);

        $sp2 = new Sponsoring();
        $sp2->setGodparent($this->getReference('sponsor-godparent-2'));
        $this->getReference('sponsor-godparent-2')->addSponsoring($sp2);
        $sp2->setFormula($this->getReference('zpb-sponsor-sponsor-desc-2'));
        $sp2->setStartAt($now);
        $sp2->setEndAt($aYear);
        $sp2->setType($types['enligne']);
        $manager->persist($sp2);

        $sp3 = new Sponsoring();
        $sp3->setGodparent($this->getReference('sponsor-godparent-2'));
        $this->getReference('sponsor-godparent-2')->addSponsoring($sp3);
        $sp3->setFormula($this->getReference('zpb-sponsor-sponsor-desc-4'));
        $sp3->setStartAt($now);
        $sp3->setEndAt($aYear);
        $sp3->setType($types['enligne']);
        $manager->persist($sp3);

        $manager->flush();

        $this->addReference('zpb-sponsoring-1', $sp1);
        $this->addReference('zpb-sponsoring-2', $sp2);
        $this->addReference('zpb-sponsoring-3', $sp3);

    }
    
    public function getOrder()
    {
        return 50;
    }
}

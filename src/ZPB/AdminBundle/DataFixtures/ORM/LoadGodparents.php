<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 16:51
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
use ZPB\AdminBundle\Entity\Godparent;


class LoadGodparents extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    function load(ObjectManager $manager)
    {
        $gp1 = new Godparent();
        $gp1->setTmp('aze123rty456uio789pq');
        $gp1->setFirstname('nicolas');
        $gp1->setLastname('canfrère');
        $gp1->setUsername('nicolas41');
        $gp1->setEmail('nico.canfrere@gmail.com');
        $gp1->setPlainPassword('aze123rty456uio789pq');
        $gp1->setPhone('0674065130');
        $gp1->setBirthdate(\DateTime::createFromFormat('Y-m-d','1971-03-05'));
        $gp1->setCivilite('Mr');
        $gp1->setAddress('13 rue Dauphine');
        $gp1->setPostalCode('41130');
        $gp1->setCity('Selles/Cher');
        $gp1->setCountry('France');
        $gp1->setEnabled(true);

        $manager->persist($gp1);

        $gp2 = new Godparent();
        $gp2->setTmp('rty123rty456uio789pq');
        $gp2->setFirstname('Frederic');
        $gp2->setLastname('canfrère');
        $gp2->setUsername('frederic91');
        $gp2->setEmail('fred.canfrere@gmail.com');
        $gp2->setPlainPassword('rty123rty456uio789pq');
        $gp2->setPhone('0674065130');
        $gp2->setBirthdate(\DateTime::createFromFormat('Y-m-d','1971-03-05'));
        $gp2->setCivilite('Mr');
        $gp2->setAddress('13 rue Dauphine');
        $gp2->setPostalCode('41130');
        $gp2->setCity('Selles/Cher');
        $gp2->setCountry('France');
        $gp2->setEnabled(true);

        $manager->persist($gp2);

        $manager->flush();

        $this->addReference('sponsor-godparent-1',$gp1);
        $this->addReference('sponsor-godparent-2',$gp2);


    }

    public function getOrder()
    {
        return 44;
    }
}

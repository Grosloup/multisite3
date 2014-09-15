<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/09/2014
 * Time: 10:01
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
use ZPB\AdminBundle\Entity\AdminUser;

class LoadAdminUsers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $admin1 = new AdminUser();
        $admin1
            ->setCivility('Mr')
            ->setFirstname('Nicolas')
            ->setLastname('Canfrère')
            ->setEmail('nico.canfrere@gmail.com')
            ->setUsername('superadmin')
            ->setPlainPassword('superadminpass')
            ->setPhone('0101010101')
            ->setIsActive(true)
            ->setRoles(['ROLE_SUPERADMIN'])
        ;
        $manager->persist($admin1);

        $admin2 = new AdminUser();
        $admin2
            ->setCivility('Mr')
            ->setFirstname('Frédéric')
            ->setLastname('Canfrère')
            ->setEmail('fred.canfrere@gmail.com')
            ->setUsername('admin')
            ->setPlainPassword('adminpass')
            ->setPhone('0101010101')
            ->setIsActive(true)
            ->setRoles(['ROLE_ADMIN'])
        ;
        $manager->persist($admin2);

        $admin3 = new AdminUser();
        $admin3
            ->setCivility('Mr')
            ->setFirstname('Ludovic')
            ->setLastname('Canfrère')
            ->setEmail('ludo.canfrere@gmail.com')
            ->setUsername('user')
            ->setPlainPassword('userpass')
            ->setPhone('0101010101')
            ->setIsActive(true)
            ->setRoles(['ROLE_User'])
        ;
        $manager->persist($admin3);

        $manager->flush();

        $this->addReference('zpb-admin-user-1', $admin1);
        $this->addReference('zpb-admin-user-2', $admin2);
        $this->addReference('zpb-admin-user-3', $admin3);

    }
    
    public function getOrder()
    {
        return 5;
    }
}

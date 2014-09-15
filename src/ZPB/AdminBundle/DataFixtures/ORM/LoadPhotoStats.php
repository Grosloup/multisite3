<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 02:33
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
use ZPB\AdminBundle\Entity\PhotoStat;
use ZPB\AdminBundle\Entity\PhotoStats;

/**
 * Class LoadPhotoStats
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPhotoStats  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $photoId = 1;
        $hosts = ["zoobeauval.com","beauval-nature.com","lesjardinsdebeauval.com","leshameauxdebeauval.com","lespagodesdebeauval.com","pro.zoobeauval.com","ce.zoobeauval.com","scolaires.zoobeauval.com","groupes.zoobeauval.com"];
        $hostId = 0;
        for($i= 0; $i<1000; $i++){
            $month = rand(1,12);
            $month = ($month < 10) ? '0' . $month : $month;
            $day = rand(1,28);
            $day = ($day <10) ? '0' . $day : $day;
            $createdAt = '2014-' . $month .'-' . $day . ' 00:00:00';
            $stat = new PhotoStat();
            $photoId = rand(1,53);
            $photo = $manager->getRepository('ZPBAdminBundle:Photo')->find($photoId);
            $stat
                ->setPhotoId($photoId)
                ->setHost($hosts[$hostId])
                ->setFilename($photo->getFilename())
                ->setCreatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', $createdAt));
            $manager->persist($stat);



            $hostId++;
            if($hostId == 9){
                $hostId = 0;
            }
        }

        $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 300;
    }
}

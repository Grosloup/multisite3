<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/09/2014
 * Time: 09:49
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
use Symfony\Component\Finder\Finder;

class LoadPhotos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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



    }
    
    public function getOrder()
    {
        return 1;
    }

    private function reloadAssets()
    {
        $fs = $this->container->get('filesystem');
        $finder = new Finder();

        $imageDir = $this->container->getParameter('zpb.photo.root_dir') .
            $this->container->getParameter('zpb.photo.web_dir');
        $thumbDir = $this->container->getParameter('zpb.photo.root_dir') .
            $this->container->getParameter('zpb.photo.thumbs.upload_dir');

        $finder->files()->in($imageDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $fs->remove($file->getRealPath());
        }
        $finder->files()->in($thumbDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $fs->remove($file->getRealPath());
        }

        $fixturesPhotosDir = $this->container->getParameter('zpb.photo.root_dir') .
            'fixtures/photos/';
        $fixturesPhotosTmpDir = $this->container->getParameter('zpb.photo.root_dir') .
            'fixtures/photos/tmp/';
        $finder->files()->in($fixturesPhotosTmpDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $fs->remove($file->getRealPath());
        }

        $finder->files()->in($fixturesPhotosDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            $fs->copy($file->getRealPath(), $fixturesPhotosTmpDir . $file->getFilename());
        }

    }
}

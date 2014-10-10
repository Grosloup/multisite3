<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/09/2014
 * Time: 18:01
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
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadMediaImage extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $this->reloadAssets();
        $imgFactory = $this->container->get('zpb.image_factory');
        //$resizer = $this->container->get('zpb.photo_resizer');
        $finder = new Finder();
        $fixturesPhotosTmpDir = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] .
            'fixtures/imgs/tmp/';
        $finder->files()->in($fixturesPhotosTmpDir)->ignoreDotFiles(true);
        $k = 1;

        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $img = $imgFactory->create();
            $img->setFilename('image_' . $k)
                ->setTitle('Etiam sodales eget nunc ut bibendum')

                ->file = new UploadedFile($file->getRealPath(), pathinfo($file->getRealPath(), PATHINFO_FILENAME), null, null, null, true);
            $img->upload();
            $resizer = $this->container->get('zpb.image_resizer');
            // $resizer->makeThumbnails($img);
            $manager->persist($img);
            $this->addReference('zpb-image-' . $k, $img);
            $k++;

        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 28;
    }

    private function reloadAssets()
    {
        $fs = $this->container->get('filesystem');

        $finder = new Finder();

        $imageDir = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] .
            $this->container->getParameter('zpb.medias.options')['zpb.img.web_dir'];
        $thumbDir = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] .
            $this->container->getParameter('zpb.medias.options')['zpb.img.thumbs.upload_dir'];
        if(!file_exists($thumbDir)){
            $fs->mkdir($thumbDir);
        }

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

        $fixturesPhotosDir = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] .
            'fixtures/imgs/';
        $fixturesPhotosTmpDir = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] .
            'fixtures/imgs/tmp/';
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

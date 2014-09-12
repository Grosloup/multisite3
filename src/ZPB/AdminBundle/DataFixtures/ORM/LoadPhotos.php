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
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $this->reloadAssets();
        $photoFactory = $this->container->get('zpb.photo_factory');
        $resizer = $this->container->get('zpb.photo_resizer');
        $finder = new Finder();
        $fixturesPhotosTmpDir = $this->container->getParameter('zpb.medias.options')['zpb.photo.root_dir'] .
            'fixtures/photos/tmp/';
        $finder->files()->in($fixturesPhotosTmpDir)->ignoreDotFiles(true);
        $k = 1;
        $c = 1;
        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $img = $photoFactory->create();
            $img->setFilename('image_' . $k)

            ->setCategory($this->getReference('zpb-photo-cat-' . $c))
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pulvinar dui vel urna sodales porta. Etiam non neque nec tortor elementum scelerisque sit amet a nunc. Nunc a odio tempor sapien interdum convallis.')
            ->setLegend('Suspendisse fermentum malesuada feugiat.')
            ->file = new UploadedFile($file->getRealPath(), pathinfo($file->getRealPath(), PATHINFO_FILENAME), null, null, null, true);
            $img->upload();
            $resizer->makeThumbnails($img);
            $manager->persist($img);
            $this->addReference('zpb-photo-' . $k, $img);
            $k++;
            $c++;
            if($c == 5){
                $c = 1;
            }
        }
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 16;
    }

    private function reloadAssets()
    {
        $fs = $this->container->get('filesystem');
        $finder = new Finder();

        $imageDir = $this->container->getParameter('zpb.medias.options')['zpb.photo.root_dir'] .
            $this->container->getParameter('zpb.medias.options')['zpb.photo.web_dir'];
        $thumbDir = $this->container->getParameter('zpb.medias.options')['zpb.photo.root_dir'] .
            $this->container->getParameter('zpb.medias.options')['zpb.photo.thumbs.upload_dir'];

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

        $fixturesPhotosDir = $this->container->getParameter('zpb.medias.options')['zpb.photo.root_dir'] .
            'fixtures/photos/';
        $fixturesPhotosTmpDir = $this->container->getParameter('zpb.medias.options')['zpb.photo.root_dir'] .
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

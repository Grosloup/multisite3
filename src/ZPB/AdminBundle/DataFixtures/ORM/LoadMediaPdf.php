<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 23:27
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
use ZPB\AdminBundle\Entity\MediaPdf;

/**
 * Class LoadMediaPdf
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadMediaPdf  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $this->reloadAssets();
        $pdfFactory = $this->container->get('zpb.pdf_factory');
        $finder = new Finder();
        $fixturesPdfsTmpDir = $this->container->getParameter('zpb.medias.options')['zpb.img.root_dir'] .
            'fixtures/pdfs/tmp/';
        $finder->files()->in($fixturesPdfsTmpDir)->ignoreDotFiles(true);
        $k = 1;

        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $pdf = $pdfFactory->create();
            $pdf->setFilename('pdf_' . $k)
                ->setTitle($titles[$k-1])

                ->file = new UploadedFile($file->getRealPath(), pathinfo($file->getRealPath(), PATHINFO_FILENAME), null, null, null, true);
            $pdf->upload();
            $pdf->setInstitution($this->getReference('zpb-instit-1'));
            //$resizer->makeThumbnails($img);
            $manager->persist($pdf);
            $this->addReference('zpb-pdf-' . $k, $pdf);
            $k++;

        }
        $manager->flush();
        // $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 100;
    }

    private function reloadAssets()
    {
        $fs = $this->container->get('filesystem');

        $finder = new Finder();

        $pdfDir = $this->container->getParameter('zpb.medias.options')['zpb.pdf.root_dir'] .
            $this->container->getParameter('zpb.medias.options')['zpb.pdf.web_dir'];


        $finder->files()->in($pdfDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $fs->remove($file->getRealPath());
        }

        $fixturesPdfsDir = $this->container->getParameter('zpb.medias.options')['zpb.pdf.root_dir'] .
            'fixtures/pdfs/';
        $fixturesPhotosTmpDir = $this->container->getParameter('zpb.medias.options')['zpb.pdf.root_dir'] .
            'fixtures/pdfs/tmp/';
        $finder->files()->in($fixturesPhotosTmpDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            /** @var \SplFileInfo $file */
            $fs->remove($file->getRealPath());
        }

        $finder->files()->in($fixturesPdfsDir)->ignoreDotFiles(true);
        foreach($finder as $file){
            $fs->copy($file->getRealPath(), $fixturesPhotosTmpDir . $file->getFilename());
        }
    }
}

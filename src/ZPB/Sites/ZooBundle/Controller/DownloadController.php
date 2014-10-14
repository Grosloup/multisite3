<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 00:07
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

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\PdfStat;
use ZPB\AdminBundle\Entity\PhotoHdStat;
use ZPB\AdminBundle\Entity\PhotoStat;

class DownloadController extends BaseController
{
    /*
     * ZooBundle routing
     * zpb_sites_zoo_download_image
     *
     */
    public function downloadImageAction($filename, $_format, Request $request)
    {
        $filename = str_replace('.'.$_format, '', $filename);
        /** @var \ZPB\AdminBundle\Entity\Photo $image */
        $image = $this->getRepo('ZPBAdminBundle:Photo')->findOneByFilename($filename);
        if(!$image || !file_exists($image->getAbsolutePath())){
            throw $this->createNotFoundException();
        }
        $stat = new PhotoStat();
        $stat->setFilename($filename)->setPhotoId($image->getId())->setHost($request->getHost());
        $this->getManager()->persist($stat);
        $this->getManager()->flush();

        $response = new BinaryFileResponse($image->getAbsolutePath());
        $response->headers->set('Content-Type', $image->getMime());
        $response->setContentDisposition( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $image->getFilename() . '.' .$image->getExtension());
        return $response;
    }

    /*
     * ZooBundle routing
     * zpb_sites_zoo_download_image_hd
     *
     */
    public function downloadHDImageAction($filename, $_format, Request $request)
    {
        $filename = str_replace('.'.$_format, '', $filename);
        /** @var \ZPB\AdminBundle\Entity\PhotoHd $photo */
        $photo = $this->getRepo('ZPBAdminBundle:PhotoHd')->findOneByFilename($filename);
        if(!$photo || !file_exists($photo->getAbsolutePath())){
            throw $this->createNotFoundException();
        }
        $stat = new PhotoHdStat();
        $stat
            ->setFilename($filename)
            ->setPhotoId($photo->getId())
            ->setHost($request->getHost());
        $this->getManager()->persist($stat);
        $this->getManager()->flush();
        $response = new BinaryFileResponse($photo->getAbsolutePath());
        $response->headers->set('Content-Type', $photo->getMime());
        $response->setContentDisposition( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $photo->getFilename() . '.' .$photo->getExtension());
        return $response;
    }

    /*
     * ZooBundle routing
     * zpb_sites_zoo_download_pdf
     *
     */
    public function downloadPdfAction($filename, $_format, Request $request)
    {

        $filename = str_replace('.'.$_format, '', $filename);
        /** @var \ZPB\AdminBundle\Entity\MediaPdf $pdf */
        $pdf = $this->getRepo('ZPBAdminBundle:MediaPdf')->findOneByFilename($filename);
        if(!$pdf || !file_exists($pdf->getAbsolutePath())){
            throw $this->createNotFoundException();
        }
        $stat = new PdfStat();
        $stat
            ->setFilename($filename)
            ->setPdfId($pdf->getId())
            ->setHost($request->getHost());
        $this->getManager()->persist($stat);
        $this->getManager()->flush();
        $response = new BinaryFileResponse($pdf->getAbsolutePath());
        $response->setContentDisposition( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $pdf->getFilename() . '.' .$pdf->getExtension());
        return $response;
    }
}

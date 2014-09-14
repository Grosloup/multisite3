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
use ZPB\AdminBundle\Entity\PhotoStat;

class DownloadController extends BaseController
{
    public function downloadImageAction($filename, Request $request)
    {
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

    public function downloadImagePdf($filename, Request $request)
    {
        //TODO
    }
}

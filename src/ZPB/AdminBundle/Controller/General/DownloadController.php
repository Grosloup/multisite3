<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/10/2014
 * Time: 00:26
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

namespace ZPB\AdminBundle\Controller\General;


use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ZPB\AdminBundle\Controller\BaseController;

class DownloadController extends BaseController
{
    public function pdfAction($filename, $_format)
    {
        $filename = str_replace('.'.$_format, '', $filename);
        /** @var \ZPB\AdminBundle\Entity\MediaPdf $pdf */
        $pdf = $this->getRepo('ZPBAdminBundle:MediaPdf')->findOneByFilename($filename);
        if(!$pdf || !file_exists($pdf->getAbsolutePath())){
            throw $this->createNotFoundException();
        }

        $response = new BinaryFileResponse($pdf->getAbsolutePath());
        $response->setContentDisposition( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $pdf->getFilename() . '.' .$pdf->getExtension());
        return $response;
    }
}

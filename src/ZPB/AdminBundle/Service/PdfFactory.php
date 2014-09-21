<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 23:54
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

namespace ZPB\AdminBundle\Service;


use Symfony\Component\HttpFoundation\File\File;

class PdfFactory
{
    private $options = [];

    public function __construct(array $options)
    {

        $this->options = $options;
    }

    public function create()
    {
        $class = $this->options['zpb.pdf.class'];
        /** @var \ZPB\AdminBundle\Entity\MediaPdf $pdf */
        $pdf = new $class();

        $pdf->setRootDir($this->options['zpb.pdf.root_dir']);
        $pdf->setWebDir($this->options['zpb.pdf.web_dir']);
        $pdf->setCopyright($this->options['zpb.document.default_copyright.text']);
        $pdf->setMime('application/pdf');
        return $pdf;
    }

    public function createFromFile(File $file)
    {
        $pdf = $this->create();
        $pdf->setExtension($file->getExtension());
        $pdf->setFilename(pathinfo($file->getFilename(), PATHINFO_FILENAME));

        return $pdf;

    }


}

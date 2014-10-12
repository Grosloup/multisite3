<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/10/2014
 * Time: 23:47
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

namespace ZPB\AdminBundle\Twig;


use Doctrine\ORM\EntityManager;

class ZPBExtension extends \Twig_Extension{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('pdf_url', [$this, 'pdfUrl']),
            new \Twig_SimpleFunction('reel_pdf_url', [$this, 'reelPdfUrl']),
            new \Twig_SimpleFunction('img_url', [$this, 'imgUrl']),
            new \Twig_SimpleFunction('img_thmb', [$this, 'imgThumb'])
        ];
    }

    public function pdfUrl($id)
    {
        $pdf = $this->em->getRepository('ZPBAdminBundle:MediaPdf')->find($id);
        if(!$pdf){
            return null;
        }
        return '/telecharger/pdf/' . $pdf->getFilename() . '.pdf';
    }

    public function reelPdfUrl($id)
    {
        $pdf = $this->em->getRepository('ZPBAdminBundle:MediaPdf')->find($id);
        if(!$pdf){
            return null;
        }
        return $pdf->getWebPath();
    }

    public function imgUrl($id)
    {
        $img = $this->em->getRepository('ZPBAdminBundle:MediaImage')->find($id);
        if(!$img){
            return null;
        }
        return '/telecharger/image/' . $img->getFilename();  //TODO set extension
    }

    public function imgThumb($id, $size='regular')
    {
        $img = $this->em->getRepository('ZPBAdminBundle:MediaImage')->find($id);
        if(!$img){
            return null;
        }
        return $img->getWebThumbPath($size);
    }

    public function getName()
    {
        return 'zpb_extension';
    }
}

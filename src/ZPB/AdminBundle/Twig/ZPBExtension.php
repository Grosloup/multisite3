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
        ];
    }

    public function pdfUrl($id)
    {
        $pdf = $this->em->getRepository('ZPBAdminBundle:MediaPdf')->find($id);
        if(!$pdf){
            return null;
        }
        return '/telecharger/pdf/' . $pdf->getFilename();
    }

    public function imgUrl($id)
    {
        $img = $this->em->getRepository('ZPBAdminBundle:MediaImage')->find($id);
        if(!$img){
            return null;
        }
        return '/telecharger/image/' . $img->getFilename();
    }

    public function getName()
    {
        return 'zpb_extension';
    }
}

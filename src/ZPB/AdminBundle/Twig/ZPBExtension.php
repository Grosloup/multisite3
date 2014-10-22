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
            new \Twig_SimpleFunction('img_thumb', [$this, 'imgThumb']),
            new \Twig_SimpleFunction('post_img_url', [$this, 'postImgUrl']),

            new \Twig_SimpleFunction('post_bandeau_img_url', [$this, 'postBandeauImgUrl']),
            new \Twig_SimpleFunction('post_bandeau_img_def_url', [$this, 'postBandeauImgDefUrl']),


            new \Twig_SimpleFunction('post_squarre_img_url', [$this, 'postSquarreImgUrl']),
            new \Twig_SimpleFunction('post_squarre_img_def_url', [$this, 'postSquarreImgDefUrl']),

            new \Twig_SimpleFunction('post_fb_img_url', [$this, 'fbImgUrl']),
            new \Twig_SimpleFunction('post_fb_img_def_url', [$this, 'fbImgDefUrl']),
        ];
    }

    public function fbImgUrl($id)
    {
        if(!$id){
            return null;
        }
        $img = $this->em->getRepository('ZPBAdminBundle:MediaImage')->find($id);
        if(!$img){
            return null;
        }
        return $img->getWebThumbPath('regular');
    }
    public function fbImgDefUrl()
    {
        return '/img/sites/zoo/fb_default.jpg';
    }

    public function postBandeauImgUrl($id)
    {
        if(!$id){
            return null;
        }
        $img = $this->em->getRepository('ZPBAdminBundle:MediaImage')->find($id);
        if(!$img){
            return null;
        }
        return $img->getWebThumbPath('regular');
    }

    public function postBandeauImgDefUrl()
    {
        return '/img/sites/zoo/bandeau_default.jpg';
    }

    public function postSquarreImgUrl($id)
    {
        if(!$id){
            return null;
        }
        $img = $this->em->getRepository('ZPBAdminBundle:MediaImage')->find($id);
        if(!$img){
            return null;
        }
        return $img->getWebThumbPath('regular');
    }

    public function postSquarreImgDefUrl()
    {
        return '/img/sites/zoo/squarre_default.jpg';
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
        $img = $this->em->getRepository('ZPBAdminBundle:Photo')->find($id);
        if(!$img){
            return null;
        }
        return '/telecharger/image/' . $img->getFilename() . '.' . $img->getExtension();
    }

    public function imgHdUrl($id)
    {
        $img = $this->em->getRepository('ZPBAdminBundle:Photo')->find($id);
        if(!$img){
            return null;
        }
        return '/telecharger/image-hd/' . $img->getFilename() . '.' . $img->getExtension();
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

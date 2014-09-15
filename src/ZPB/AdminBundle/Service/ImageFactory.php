<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 07/09/2014
 * Time: 11:09
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
use ZPB\AdminBundle\Entity\ResizeableInterface;

class ImageFactory
{
    private $sizes = [];
    private $options = [];

    public function __construct(array $sizes, array $options)
    {
        $this->sizes = $sizes;
        $this->options = $options;
    }

    public function create()
    {
        $class = $this->options['zpb.image.class'];
        /** @var \ZPB\AdminBundle\Entity\MediaImage $image */
        $image = new $class();
        $image->setRootDir($this->options['zpb.img.root_dir']);
        $image->setWebDir($this->options['zpb.img.web_dir']);
        $image->setCopyright($this->options['zpb.document.default_copyright.text']);
        return $image;
    }

    public function createFromFile(File $file)
    {
        $image = $this->create();
        $image->setExtension($file->getExtension());
        $image->setFilename(pathinfo($file->getFilename(), PATHINFO_FILENAME));
        $image->setMime($file->getMimeType());
        $size = getimagesize($image->getAbsolutePath());
        $image->setWidth($size[0]);
        $image->setHeight($size[1]);
        return $image;
    }

    public function getWebThumb($key = 'regular',ResizeableInterface $img = null)
    {
        if(!$img){
            return null; // TODO image par défaut
        }
        return '/' . $this->options['zpb.img.thumbs.upload_dir'] . $key . '_' .$img->getFilename() . '.' .$img->getExtension();
    }
}

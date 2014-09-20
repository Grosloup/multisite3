<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 09:09
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


use ZPB\AdminBundle\Entity\ResizeableInterface;

class PhotoResizer
{
    private $sizes = [];
    private $options = [];

    public function __construct(array $sizes, array $options)
    {
        $this->sizes = $sizes;
        $this->options = $options;
    }

    public function makeThumbnails(ResizeableInterface $img)
    {
        foreach($this->sizes as $key => $size){
            $this->reduce($img, $size, $key);
        }
    }

    public function resize(ResizeableInterface $img)
    {

    }

    public function reduce(ResizeableInterface $img, $size, $key)
    {
        if ($img->getWidth() >= $img->getHeight()) {
            $this->landscape($img, $size, $key);
        }

        if ($img->getWidth() < $img->getHeight()) {
            $this->portrait($img, $size, $key);
        }
    }

    public function landscape(ResizeableInterface $img, $size, $key)
    {
        $dest = $this->options['zpb.photo.root_dir'] . $this->options['zpb.photo.thumbs.upload_dir'] . $key . '_' . $img->getFilename() . '.' . $img->getExtension();
        $filename = $img->getAbsolutePath();
        $image = $this->createImage($filename, $img->getMime());
        $redim = imagecreatetruecolor($size["width"], $size["height"]);
        $white = imagecolorallocate($redim, 255,255,255);
        imagefill($redim,0,0, $white);

        if($img->getWidth() > $size["width"]){
            $ratio = $size["width"] / $img->getWidth();
            $newHeight  = $img->getHeight() * $ratio;
            $y = floor(($size['height'] - $newHeight) / 2);
            imagecopyresampled($redim, $image, 0,$y,0,0, $size["width"], $newHeight, $img->getWidth(), $img->getHeight());
            $this->save($redim, $dest, $img->getMime());
            imagedestroy($redim);
        } else {
            $x = floor(($size['width'] - $img->getWidth()) / 2);
            $y = floor(($size['height'] - $img->getHeight()) / 2);
            imagecopyresampled($redim, $image, $x,$y,0,0, $size["width"], $size['height'], $img->getWidth(), $img->getHeight());
        }


    }

    public function portrait(ResizeableInterface $img, $size, $key)
    {
        $dest = $this->options['zpb.photo.root_dir'] . $this->options['zpb.photo.thumbs.upload_dir'] . $key . '_' . $img->getFilename() . '.' . $img->getExtension();
        $filename = $img->getAbsolutePath();
        $image = $this->createImage($filename, $img->getMime());
        $redim = imagecreatetruecolor($size["width"], $size["height"]);
        $white = imagecolorallocate($redim, 255,255,255);
        imagefill($redim,0,0, $white);

        if($img->getHeight() > $size["height"]){
            $ratio = $size["height"] / $img->getHeight();
            $newWidth  = $img->getWidth() * $ratio;
            $x = floor(($size['width'] - $newWidth) / 2);
            imagecopyresampled($redim, $image, $x, 0,0,0, $newWidth, $size['height'], $img->getWidth(), $img->getHeight());
            $this->save($redim, $dest, $img->getMime());
            imagedestroy($redim);
        } else {
            $x = floor(($size['width'] - $img->getWidth()) / 2);
            $y = floor(($size['height'] - $img->getHeight()) / 2);
            imagecopyresampled($redim, $image, $x,$y,0,0, $size["width"], $size['height'], $img->getWidth(), $img->getHeight());
        }
    }

    private function createImage($file, $mime = 'image/jpeg')
    {
        $img = null;
        switch ($mime) {
            case 'image/png':
                $img = imagecreatefrompng($file);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($file);
                break;
            case 'image/jpeg':
                $img = imagecreatefromjpeg($file);
                break;
        }
        return $img;
    }

    private function save($image, $destination, $mime = 'image/jpeg', $quality = 100)
    {
        switch ($mime) {
            case 'image/png':
                imagepng($image, $destination);
                break;
            case 'image/gif':
                imagegif($image, $destination);
                break;
            case 'image/jpeg':
                imagejpeg($image, $destination, $quality);
                break;
        }
    }
}

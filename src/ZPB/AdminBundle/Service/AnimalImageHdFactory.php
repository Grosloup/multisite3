<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 21:33
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


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use ZPB\AdminBundle\Entity\AnimalImageHd;
use ZPB\AdminBundle\Entity\ResizeableInterface;

class AnimalImageHdFactory
{
    /**
     * @var array
     */
    private $options;

    private $fs;

    public function __construct($options, $fs)
    {
        $this->options = $options;
        $this->fs = $fs;
    }

    public function getBasePath()
    {
        return $this->options['zpb.hd.root_dir'] . $this->options['zpb.hd.web_dir'];
    }

    public function getPath()
    {
        return $this->getBasePath() . 'hd_' . time() . '.jpg';
    }

    public function getThumbPath()
    {
        return $this->options['zpb.hd.root_dir']  . $this->options['zpb.hd.thumb_dir'];
    }

    public function createFromFile(File $file)
    {
        $class = $this->options['zpb.hd.class'];
        /** @var AnimalImageHd $image */
        $image = new $class();
        $image->setRootDir($this->options['zpb.hd.root_dir']);
        $image->setWebDir($this->options['zpb.hd.web_dir']);
        $image->setThumbDir($this->options['zpb.hd.thumb_dir']);
        $image->setFilename(pathinfo($file->getFilename(), PATHINFO_FILENAME));
        $image->setExtension($file->getExtension());
        $image->setMime($file->getMimeType());
        $size = getimagesize($file->getPathname());
        $image->setWidth($size[0]);
        $image->setHeight($size[1]);

        return $image;
    }

    public function makeThumb(ResizeableInterface $image)
    {
        $file = $image->getAbsolutePath();
        $dest = $image->getRootDir() . $image->getThumbDir() . $image->getFilename() . '.' . $image->getExtension();
        $img = $this->createImage($file, $image->getMime());

        $newWidth = $this->options['hd_thumb_max_width'];
        $newHeight = $this->options['hd_thumb_max_width'];
        $redim = imagecreatetruecolor($newWidth, $newHeight);

        $white = imagecolorallocate($redim, 255,255,255);

        imagefill($redim,0,0, $white);
        if($image->getWidth() > $newWidth){
            $ratio = $newWidth / $image->getWidth();
            $calcHeight  = $image->getHeight() * $ratio;
            $y = floor(($newHeight - $calcHeight) / 2);
            imagecopyresampled($redim, $img, 0,$y,0,0, $newWidth, $calcHeight, $image->getWidth(), $image->getHeight());

        } else {
            $x = floor(($newWidth - $image->getWidth()) / 2);
            $y = floor(($newHeight - $image->getHeight()) / 2);
            imagecopyresampled($redim, $img, $x,$y,0,0, $newWidth, $newHeight, $image->getWidth(), $image->getHeight());
        }

        $this->save($redim, $dest, $image->getMime());
        imagedestroy($redim);

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

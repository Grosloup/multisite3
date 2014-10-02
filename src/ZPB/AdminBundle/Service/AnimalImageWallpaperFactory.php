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


use Symfony\Component\HttpFoundation\File\File;
use ZPB\AdminBundle\Entity\AnimalImageWallpaper;
use ZPB\AdminBundle\Entity\ResizeableInterface;

class AnimalImageWallpaperFactory extends AbstractAnimalImageFactory
{


    public function getBasePath()
    {
        return $this->options['zpb.wallpaper.root_dir'] . $this->options['zpb.wallpaper.web_dir'];
    }

    public function getPath()
    {
        return $this->getBasePath() . 'wallpaper_' . time() . '.jpg';
    }

    public function getThumbPath()
    {
        return $this->options['zpb.wallpaper.root_dir']  . $this->options['zpb.wallpaper.thumb_dir'];
    }

    public function createFromFile(File $file)
    {
        $class = $this->options['zpb.wallpaper.class'];
        /** @var AnimalImageWallpaper $image */
        $image = new $class();
        $image->setRootDir($this->options['zpb.wallpaper.root_dir']);
        $image->setWebDir($this->options['zpb.wallpaper.web_dir']);
        $image->setThumbDir($this->options['zpb.wallpaper.thumb_dir']);
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

        $newWidth = $this->options['wallpaper_thumb_max_width'];
        $newHeight = $this->options['wallpaper_thumb_max_width'];
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
}

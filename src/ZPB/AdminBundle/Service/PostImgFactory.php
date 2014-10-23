<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 23/10/2014
 * Time: 22:46
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


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class PostImgFactory {
    private $options = [];

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function create()
    {
        $class = $this->options['zpb.post_image.class'];
        /** @var \ZPB\AdminBundle\Entity\PostImg $image */
        $image = new $class();
        $image->setRootDir($this->options['zpb.img.root_dir']);
        $image->setWebDir($this->options['zpb.img.web_dir']);
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

    public function createDirs(Filesystem $fs)
    {
        $rootDir = rtrim($this->options['zpb.post_image.root_dir'] . $this->options['zpb.post_image.web_dir'], '/');
        if(!$fs->exists($rootDir)){
            $fs->mkdir($rootDir);
        }
        return $rootDir;
    }

    public function isMimeAllowed($mime)
    {
        return in_array($mime, $this->options['allowedMimes']);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 02/10/2014
 * Time: 11:32
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

class AbstractAnimalImageFactory {

    /**
     * @var array
     */
    protected $options;

    protected $fs;

    public function __construct($options, $fs)
    {
        $this->options = $options;
        $this->fs = $fs;
    }

    public function getBasePath(){}

    public function getPath(){}

    public function getThumbPath(){}

    public function createFromFile(File $file){}

    public function makeThumb(ResizeableInterface $image){}

    protected function createImage($file, $mime = 'image/jpeg')
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

    protected function save($image, $destination, $mime = 'image/jpeg', $quality = 100)
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

<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 24/10/2014
 * Time: 16:26
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

class AbstractImageFactory {

    protected  $options = [];

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function create()
    {}
    public function createFromFile(File $file)
    {}
    public function createDirs(Filesystem $fs)
    {}

    public function isMimeAllowed($mime)
    {
        return in_array($mime, $this->options['allowedMimes']);
    }
}

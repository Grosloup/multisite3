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

class AnimalImageHdFactory
{
    /**
     * @var array
     */
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function getBasePath()
    {
        return $this->options['zpb.hd.root_dir'] . $this->options['zpb.hd.web_dir'];
    }

    public function path()
    {

    }

    public function createFromFile(File $file)
    {

    }
}

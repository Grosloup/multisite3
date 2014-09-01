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


class PhotoFactory
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

        $class = $this->options['zpb.photo.class'];
        /** @var \ZPB\AdminBundle\Entity\Photo $photo */
        $photo = new $class();

        $photo->setRootDir($this->options['zpb.photo.root_dir']);
        $photo->setWebDir($this->options['zpb.photo.web_dir']);
        $photo->setCopyright($this->options['zpb.document.default_copyright.text']);

        return $photo;
    }
} 

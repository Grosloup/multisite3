<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/10/2014
 * Time: 11:10
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

class PhotoHdFactory {
    private $sizes = [];
    private $options = [];

    public function __construct(array $sizes, array $options)
    {
        $this->sizes = $sizes;
        $this->options = $options;
    }

    /**
     * @return \ZPB\AdminBundle\Entity\Photo
     */
    public function create($institutionId)
    {

        $class = $this->options['zpb.photo_hd.class'];
        /** @var \ZPB\AdminBundle\Entity\PhotoHd $photo */
        $photo = new $class();
        $photo->setInstitutionId($institutionId);
        $photo->setRootDir($this->options['zpb.photo_hd.root_dir']);
        $photo->setWebDir($this->options['zpb.photo_hd.web_dir']);
        $photo->setThumbDir($this->options['zpb.photo_hd.thumbs.upload_dir']);
        $photo->setCopyright($this->options['zpb.document.default_copyright.text']);

        $sizes = [];
        foreach ($this->sizes as $k => $v) {
            $sizes[] = $k;
        }

        $photo->setSizes($sizes);

        return $photo;
    }

    public function createDirs(Filesystem $fs)
    {
        $rootDir = rtrim($this->options['zpb.photo_hd.root_dir'] . $this->options['zpb.photo_hd.web_dir'], '/');
        $thumbDir = rtrim($this->options['zpb.photo_hd.root_dir'] . $this->options['zpb.photo_hd.thumbs.upload_dir'], '/');
        if(!$fs->exists($rootDir)){
            $fs->mkdir($rootDir);
        }

        if(!$fs->exists($thumbDir)){
            $fs->mkdir($thumbDir);
        }
    }
}

<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaImage
 *
 * @ORM\Table(name="zpb_media_images")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\MediaImageRepository")
 * @UniqueEntity("filename", message="Un fichier image du même nom existe déjà.")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaImage implements ResizeableInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     * @Assert\Image(maxSize="6M", maxSizeMessage="La taille de votre fichier dépasse le maximum autorisé.", mimeTypes={"image/jpeg","image/gif","image/png"}, mimeTypesMessage="Votre image n\'est pas d\'un type autorisé.")
     */
    public $file;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=true, unique=true)
     * @Assert\Regex("/^[a-zA-Z0-9._-]*$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $filename;
    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=6, nullable=false)
     */
    private $extension;
    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=50, nullable=false)
     */
    private $mime;
    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
    private $width;
    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height;
    /**
     * @var string
     *
     * @ORM\Column(name="rootDir", type="string", length=255, nullable=false)
     */
    private $rootDir;
    /**
     * @var string
     *
     * @ORM\Column(name="webDir", type="string", length=255, nullable=false)
     */
    private $webDir;
    /**
     * @var string
     *
     * @ORM\Column(name="thumb_dir", type="string", length=255, nullable=false)
     */
    private $thumbDir;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;
    /**
     * @var string
     * @ORM\Column(name="copyright", type="string", nullable=false, length=255)
     */
    private $copyright;
    /**
     * @var string
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;
    /**
     * @var string
     */
    private $absolutePath;
    /**
     * @var string
     * @ORM\Column(name="long_id", type="string", length=15, nullable=false, unique=true)
     */
    private $longId;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\MediaImageUseCase", mappedBy="image")
     */
    private $use_cases;

    /**
     * @ORM\Column(name="sizes_keys", type="array")
     */
    private $sizes;

    /**
     * @ORM\Column(name="in_use_counter", type="integer", nullable=true)
     */
    private $inUseCounter;

    private $thumbPaths = [];

    public function __construct()
    {
        $now = (new \DateTime())->getTimestamp();
        $this->longId = substr(base_convert(sha1(uniqid($now, true)), 16, 36), 0, 15);
        $this->use_cases = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * Set longId
     *
     * @param string $longId
     * @return MediaImage
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;

        return $this;
    }

    public function upload()
    {
        if ($this->file == null) {
            return false;
        }

        $this->extension = $this->file->guessExtension();
        $this->mime = $this->file->getMimeType();
        $dest = $this->rootDir . $this->webDir;

        if (!$this->filename) {
            $this->filename = pathinfo($this->sanitizeFilename($this->file->getClientOriginalName()), PATHINFO_FILENAME);
        }
        $this->file->move($dest, $this->filename . '.' . $this->extension);
        $size = getimagesize($this->getAbsolutePath());
        $this->width = $size[0];
        $this->height = $size[1];
        $this->file = null;

        return true;
    }

    private function sanitizeFilename($string = "")
    {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $string);
    }

    /**
     * @return mixed
     */
    public function getInUseCounter()
    {
        return $this->inUseCounter;
    }

    /**
     * @param mixed $inUseCounter
     * @return MediaImage
     */
    public function setInUseCounter($inUseCounter)
    {
        $this->inUseCounter = $inUseCounter;
        return $this;
    }

    public function addInUse()
    {
        $this->inUseCounter += 1;
        return $this;
    }

    public function subInUse()
    {
        if($this->inUseCounter > 0){
            $this->inUseCounter -= 1;
        }
        return $this;
    }



    public function getAbsolutePath()
    {
        return $this->rootDir . $this->webDir . $this->filename . "." . $this->extension;
    }

    public function getAbsThumbPaths()
    {
        $paths = [];
        foreach($this->sizes as $size){
            $paths[] = $this->rootDir . $this->thumbDir . $size . '_' . $this->filename . '.' .$this->extension;
        }
        return $paths;
    }

    public function getWebPath()
    {
        return '/' . $this->webDir . $this->filename . "." . $this->extension;
    }

    public function getWebThumbPath($key)
    {
        return '/' . $this->thumbDir . $key . '_' . $this->filename . '.' .$this->extension;
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeAbsolutePath()
    {
        $this->absolutePath = $this->getAbsolutePath();
        $this->thumbPaths = $this->getAbsThumbPaths();
    }

    /**
     * @ORM\PostRemove()
     */
    public function deleteFile()
    {
        if (file_exists($this->absolutePath)) {
            unlink($this->absolutePath);
        }
        foreach($this->thumbPaths as $path){
            if(file_exists($path)){
                unlink($path);
            }
        }
    }

    /**
     * @return string
     */
    public function getThumbDir()
    {
        return $this->thumbDir;
    }

    /**
     * @param string $thumbDir
     * @return MediaImage
     */
    public function setThumbDir($thumbDir)
    {
        $this->thumbDir = $thumbDir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @param mixed $sizes
     * @return MediaImage
     */
    public function setSizes($sizes)
    {
        $this->sizes = $sizes;
        return $this;
    }



    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return MediaImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return MediaImage
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return MediaImage
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set mime
     *
     * @param string $mime
     * @return MediaImage
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return MediaImage
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return MediaImage
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get rootDir
     *
     * @return string
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Set rootDir
     *
     * @param string $rootDir
     * @return MediaImage
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

        return $this;
    }

    /**
     * Get webDir
     *
     * @return string
     */
    public function getWebDir()
    {
        return $this->webDir;
    }

    /**
     * Set webDir
     *
     * @param string $webDir
     * @return MediaImage
     */
    public function setWebDir($webDir)
    {
        $this->webDir = $webDir;

        return $this;
    }

    /**
     * Get ceatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ceatedAt
     *
     * @param \DateTime $createdAt
     * @return MediaImage
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return MediaImage
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * @param string $copyright
     * @return MediaImage
     */
    public function setCopyright($copyright)
    {
        $year = (new \DateTime())->format('Y');
        $this->copyright = '@ ' . trim($copyright, ' @') . ' - ' . $year;

        return $this;
    }



    /**
     * Add use_cases
     *
     * @param MediaImageUseCase $useCases
     * @return MediaImage
     */
    public function addUseCase(MediaImageUseCase $useCases)
    {
        $this->use_cases[] = $useCases;

        return $this;
    }

    /**
     * Remove use_cases
     *
     * @param MediaImageUseCase $useCases
     */
    public function removeUseCase(MediaImageUseCase $useCases)
    {
        $this->use_cases->removeElement($useCases);
    }

    /**
     * Get use_cases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUseCases()
    {
        return $this->use_cases;
    }
}

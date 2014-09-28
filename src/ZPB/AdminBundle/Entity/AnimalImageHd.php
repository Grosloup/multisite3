<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AnimalImageHd
 *
 * @ORM\Table(name="zpb_animal_images_hd")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimalImageHdRepository")
 */
class AnimalImageHd
{
    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     * @Assert\Image(maxSize="6M", maxSizeMessage="La taille de votre fichier dépasse le maximum autorisé.", mimeTypes={"image/jpeg"}, mimeTypesMessage="Votre image n\'est pas d\'un type autorisé.")
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
     * @ORM\Column(name="filename", type="string", length=255, nullable=false, unique=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=10, nullable=false)
     */
    private $extension;

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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Animal")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animal;

    /**
     * @var string
     *
     * @ORM\Column(name="root_dir", type="string", length=255, nullable=false)
     */
    private $rootDir;

    /**
     * @var string
     *
     * @ORM\Column(name="web_dir", type="string", length=255, nullable=false)
     */
    private $webDir;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb_dir", type="string", length=255, nullable=false)
     */
    private $thumbDir;

    private $absolutePath;

    private $webPath;

    private $webThumbPath;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getWebThumbPath()
    {
        return $this->webThumbPath;
    }

    /**
     * @param mixed $webThumbPath
     * @return AnimalImageHd
     */
    public function setWebThumbPath($webThumbPath)
    {
        $this->webThumbPath = $webThumbPath;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAbsolutePath()
    {
        return $this->absolutePath;
    }

    /**
     * @param mixed $absolutePath
     * @return AnimalImageHd
     */
    public function setAbsolutePath($absolutePath)
    {
        $this->absolutePath = $absolutePath;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebPath()
    {
        return $this->webPath;
    }

    /**
     * @param mixed $webPath
     * @return AnimalImageHd
     */
    public function setWebPath($webPath)
    {
        $this->webPath = $webPath;

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
     * @return AnimalImageHd
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
     * @return AnimalImageHd
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

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
     * @return AnimalImageHd
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
     * @return AnimalImageHd
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AnimalImageHd
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * @return AnimalImageHd
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
     * @return AnimalImageHd
     */
    public function setWebDir($webDir)
    {
        $this->webDir = $webDir;

        return $this;
    }

    /**
     * Get thumbDir
     *
     * @return string
     */
    public function getThumbDir()
    {
        return $this->thumbDir;
    }

    /**
     * Set thumbDir
     *
     * @param string $thumbDir
     * @return AnimalImageHd
     */
    public function setThumbDir($thumbDir)
    {
        $this->thumbDir = $thumbDir;

        return $this;
    }

    /**
     * Get animal
     *
     * @return Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set animal
     *
     * @param Animal $animal
     * @return AnimalImageHd
     */
    public function setAnimal(Animal $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }
}

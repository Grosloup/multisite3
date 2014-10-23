<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PostImg
 *
 * @ORM\Table(name="zpb_post_imgs")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PostImgRepository")
 * @UniqueEntity("filename", message="Un fichier image du même nom existe déjà.")
 * @ORM\HasLifecycleCallbacks()
 */
class PostImg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     * @Assert\Image(maxSize="6M", maxSizeMessage="La taille de votre fichier dépasse le maximum autorisé.", mimeTypes={"image/jpeg","image/gif","image/png"}, mimeTypesMessage="Votre image n\'est pas d\'un type autorisé.")
     */
    public $file;

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
     * @ORM\Column(name="extension", type="string", length=255, nullable=false)
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     *
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
    */
    private $absolutePath;


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

    public function getAbsolutePath()
    {
        return $this->rootDir . $this->webDir . $this->filename . "." . $this->extension;
    }

    public function getWebPath()
    {
        return '/' . $this->webDir . $this->filename . "." . $this->extension;
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeAbsolutePath()
    {
        $this->absolutePath = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function deleteFile()
    {
        if (file_exists($this->absolutePath)) {
            unlink($this->absolutePath);
        }
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

    /**
     * Set filename
     *
     * @param string $filename
     * @return PostImg
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

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
     * Set extension
     *
     * @param string $extension
     * @return PostImg
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

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
     * Set mime
     *
     * @param string $mime
     * @return PostImg
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

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
     * Set width
     *
     * @param integer $width
     * @return PostImg
     */
    public function setWidth($width)
    {
        $this->width = $width;

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
     * Set height
     *
     * @param integer $height
     * @return PostImg
     */
    public function setHeight($height)
    {
        $this->height = $height;

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
     * Set rootDir
     *
     * @param string $rootDir
     * @return PostImg
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

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
     * Set webDir
     *
     * @param string $webDir
     * @return PostImg
     */
    public function setWebDir($webDir)
    {
        $this->webDir = $webDir;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PostImg
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return PostImg
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
}

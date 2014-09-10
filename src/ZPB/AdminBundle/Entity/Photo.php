<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Photo
 *
 * @ORM\Table(name="zpb_phototek_photos")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PhotoRepository")
 * @UniqueEntity("filename", message="Un fichier photo du même nom existe déjà.")
 * @ORM\HasLifecycleCallbacks()
 */
class Photo implements ResizeableInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
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
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;
    /**
     * @var string
     * @ORM\Column(name="copyright", type="string", nullable=false, length=255)
     */
    private $copyright;
    /**
     * @var string
     * @ORM\Column(name="legend", type="text", nullable=true)
     */
    private $legend;
    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\PhotoCategory", inversedBy="photos")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    /**
     * @Gedmo\SortablePosition()
     * @ORM\Column(name="position", type="integer")
     */
    private $position;
    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Institution")
     * @ORM\JoinColumn(name="institution_id", referencedColumnName="id")
     */
    private $institution;
    /**
     * @var string
     */
    private $absolutePath;
    /**
     * @var string
     * @ORM\Column(name="long_id", type="string", length=15, nullable=false, unique=true)
     */
    private $longId;


    public function __construct()
    {
        $now = (new \DateTime())->getTimestamp();
        $this->longId = substr(base_convert(sha1(uniqid($now, true)), 16, 36), 0, 15);
    }

    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * Set longId
     *
     * @param string $longId
     * @return Photo
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;

        return $this;
    }

    public function upload()
    {
        if (!$this->file) {
            return false;
        }

        $this->extension = $this->file->guessExtension();
        $this->mime = $this->file->getMimeType();
        $dest = $this->rootDir . $this->webDir;

        if (!$this->filename) {
            $this->filename = $this->sanitizeFilename($this->file->getClientOriginalName());
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
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * @param string $copyright
     * @return Photo
     */
    public function setCopyright($copyright)
    {
        $year = (new \DateTime())->format('Y');
        $this->copyright = '@ ' . trim($copyright, ' @') . ' - ' . $year;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Photo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @param string $legend
     * @return Photo
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

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
     * @return Photo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Photo
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get category
     *
     * @return PhotoCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param PhotoCategory $category
     * @return Photo
     */
    public function setCategory(PhotoCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get institution
     *
     * @return Institution
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set institution
     *
     * @param Institution $institution
     * @return Photo
     */
    public function setInstitution(Institution $institution = null)
    {
        $this->institution = $institution;

        return $this;
    }
}

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
     * @Assert\Image(maxSize="6M", maxSizeMessage="La taille de votre fichier dépasse le maximum autorisé.", mimeTypes={"image/jpeg","image/gif","image/png"}, mimeTypesMessage="Votre image n\'est pas \'un type autorisé.")
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */

    /**
     * @var string
     *
     * @ORM\Column(name="thumb_dir", type="string", length=255, nullable=false)
     */
    private $thumbDir;

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
     * @Assert\Regex("[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&':+_ -]*", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;
    /**
     * @var string
     * @Assert\Regex("[a-zA-Z0-9éèêëàçâûüîïôö_ -]*", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="copyright", type="string", nullable=false, length=255)
     */
    private $copyright;
    /**
     * @var string
     * @Assert\Regex("[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&':+_ -]*", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="legend", type="text", nullable=true)
     */
    private $legend;
    /**
     * @var string
     * @Assert\Regex("[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&':+_ -]*", message="Ce champs contient des caractères non autorisés.")
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
     * @var string
     */
    private $absolutePath;

    private $thumbPaths = [];

    /**
     * @var string
     * @ORM\Column(name="long_id", type="string", length=15, nullable=false, unique=true)
     */
    private $longId;

    /**
     * @ORM\Column(name="institution_id", type="integer", nullable=true)
     */
    private $institutionId;

    /**
     * @ORM\Column(name="sizes_keys", type="array")
     */
    private $sizes;


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
     * @return string
     */
    public function getThumbDir()
    {
        return $this->thumbDir;
    }

    /**
     * @param string $thumbDir
     */
    public function setThumbDir($thumbDir)
    {
        $this->thumbDir = $thumbDir;
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
     */
    public function setSizes($sizes)
    {
        $this->sizes = $sizes;
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

    /**
     * @return mixed
     */
    public function getInstitutionId()
    {
        return $this->institutionId;
    }

    /**
     * @param mixed $institutionId
     * @return Photo
     */
    public function setInstitutionId($institutionId)
    {
        $this->institutionId = $institutionId;
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
        $this->copyright = '&copy; ' . preg_replace('/^\s+|\s+$/','',str_replace('&copy; ','', $copyright)) . ' - ' . $year;

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
        $this->institutionId = $category->getInstitution()->getId();

        return $this;
    }

}

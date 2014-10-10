<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PhotoHd
 *
 * @ORM\Table(name="zpb_phototek_photos_hd")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PhotoHdRepository")
 * @UniqueEntity("filename", message="Un fichier photo du même nom existe déjà.")
 * @ORM\HasLifecycleCallbacks()
 */
class PhotoHd implements ResizeableInterface
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
     * @Assert\Image(maxSize="6M", maxSizeMessage="La taille de votre fichier dépasse le maximum autorisé.", mimeTypes={"image/jpeg","image/gif","image/png"}, mimeTypesMessage="Votre image n\'est pas \'un type autorisé.")
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=false)
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
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&':+_ -]*$/", message="Ce champs contient des caractères non autorisés.")
     */
    private $title;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàçâûüîïôö&;_ -]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="copyright", type="string", length=255, nullable=false)
     */
    private $copyright;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&':+_ -]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="legend", type="text", nullable=true)
     */
    private $legend;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&':+_ -]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     * @Gedmo\SortablePosition()
     * @ORM\Column(name="position", type="integer")
     */
    private $position;
    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\PhotoCategory", inversedBy="photosHd")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="institution_id", type="integer")
     */
    private $institutionId;

    /**
     * @ORM\Column(name="sizes_keys", type="array")
     */
    private $sizes;

    private $absolutePath;

    private $thumbPaths = [];

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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

    public function getAbsolutePath()
    {
        return $this->rootDir . $this->webDir . $this->filename . '.' .$this->extension;
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
        return '/' . $this->webDir . $this->filename . '.' .$this->extension;
    }

    public function getWebThumbPath($key)
    {
        return '/' . $this->thumbDir . $key . '_' . $this->filename . '.' .$this->extension;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return PhotoHd
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
     * @return PhotoHd
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
     * @return PhotoHd
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
     * @return PhotoHd
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
     * @return PhotoHd
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
     * @return PhotoHd
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
     * @return PhotoHd
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
     * Set thumbDir
     *
     * @param string $thumbDir
     * @return PhotoHd
     */
    public function setThumbDir($thumbDir)
    {
        $this->thumbDir = $thumbDir;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PhotoHd
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
     * @return PhotoHd
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

    /**
     * Set title
     *
     * @param string $title
     * @return PhotoHd
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return PhotoHd
     */
    public function setCopyright($copyright)
    {
        $year = (new \DateTime())->format('Y');
        $this->copyright = '&copy; ' . preg_replace('/^\s+|\s+$/','',str_replace('&copy; ','', $copyright)) . ' - ' . $year;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set legend
     *
     * @param string $legend
     * @return PhotoHd
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string 
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PhotoHd
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return PhotoHd
     */
    public function setPosition($position)
    {
        $this->position = $position;

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
     * Set institutionId
     *
     * @param integer $institutionId
     * @return PhotoHd
     */
    public function setInstitutionId($institutionId)
    {
        $this->institutionId = $institutionId;

        return $this;
    }

    /**
     * Get institutionId
     *
     * @return integer 
     */
    public function getInstitutionId()
    {
        return $this->institutionId;
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
     * @return PhotoHd
     */
    public function setCategory(PhotoCategory $category = null)
    {
        $this->category = $category;
        $this->institutionId = $category->getInstitution()->getId();

        return $this;
    }
}

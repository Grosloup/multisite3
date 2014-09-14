<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaPdf
 *
 * @ORM\Table(name="zpb_media_pdf")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\MediaPdfRepository")
 * @UniqueEntity("filename", message="Un fichier pdf du même nom existe déjà.")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaPdf
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
     * @Assert\File(maxSize="6M", maxSizeMessage="a taille de votre fichier dépasse le maximum autorisé.", mimeTypes={"application/pdf", "application/x-pdf"}, mimeTypesMessage="Votre fichier n\'est pas unpdf valide.")
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
     * @ORM\Column(name="extension", type="string", length=10, nullable=false)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=20, nullable=false)
     */
    private $mime;

    /**
     * @var string
     *
     * @ORM\Column(name="root_dir", type="string", length=255, nullable=false)
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
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="copyright", type="string", length=255, nullable=false)
     */
    private $copyright;

    /**
     * @var string
     *
     * @ORM\Column(name="longId", type="string", length=255,nullable=false)
     */
    private $longId;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Institution", inversedBy="pdfs")
     * @ORM\JoinColumn(name="institution_id", referencedColumnName="id")
     */
    private $institution;

    /**
     * @var string
     */
    private $absolutePath;


    public function __construct()
    {
        $now = (new \DateTime())->getTimestamp();
        $this->longId = substr(base_convert(sha1(uniqid($now, true)), 16, 36), 0, 15);

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
     * @return MediaPdf
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
     * @return MediaPdf
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
     * @return MediaPdf
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
     * Set rootDir
     *
     * @param string $rootDir
     * @return MediaPdf
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
     * @return MediaPdf
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
     * @return MediaPdf
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
     * @return MediaPdf
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
     * @return MediaPdf
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
     * @return MediaPdf
     */
    public function setCopyright($copyright)
    {
        $year = (new \DateTime())->format('Y');
        $this->copyright = '@ ' . trim($copyright, ' @') . ' - ' . $year;

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
     * Set longId
     *
     * @param string $longId
     * @return MediaPdf
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;

        return $this;
    }

    /**
     * Get longId
     *
     * @return string
     */
    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * Set institution
     *
     * @param Institution $institution
     * @return MediaPdf
     */
    public function setInstitution(Institution $institution = null)
    {
        $this->institution = $institution;

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
}

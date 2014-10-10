<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PressRelease
 *
 * @ORM\Table(name="zpb_press_releases")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PressReleaseRepository")
 */
class PressRelease
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est requis.")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"title"}, unique=true)
     */
    private $slug;

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
     * @ORM\Column(name="body", type="text", nullable=false)
     * @Assert\NotBlank(message="Ce champs est requis.")
     */
    private $body;

    /**
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(name="pdf_fr_id", type="integer", nullable=false)
     * @Assert\NotBlank(message="Ce champs est requis.")
     *
     */
    private $pdfFr;

    /**
     * @ORM\Column(name="pdf_en_id", type="integer", nullable=true)
     */
    private $pdfEn;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Institution", inversedBy="faqs")
     * @ORM\JoinColumn(name="institution_id", referencedColumnName="id")
     */
    private $institution;


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
     * Set title
     *
     * @param string $title
     * @return PressRelease
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
     * Set slug
     *
     * @param string $slug
     * @return PressRelease
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PressRelease
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
     * @return PressRelease
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
     * Set body
     *
     * @param string $body
     * @return PressRelease
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set pdfFr
     *
     * @param string $pdfFr
     * @return PressRelease
     */
    public function setPdfFr($pdfFr)
    {
        $this->pdfFr = $pdfFr;

        return $this;
    }

    /**
     * Get pdfFr
     *
     * @return string
     */
    public function getPdfFr()
    {
        return $this->pdfFr;
    }

    /**
     * Set pdfEn
     *
     * @param string $pdfEn
     * @return PressRelease
     */
    public function setPdfEn($pdfEn)
    {
        if(preg_match('/^en_.+/',$pdfEn)){
            $this->pdfEn = $pdfEn;
        } else {
            $this->pdfEn = 'en_' . $pdfEn;
        }


        return $this;
    }

    /**
     * Get pdfEn
     *
     * @return string
     */
    public function getPdfEn()
    {
        return $this->pdfEn;
    }

    /**
     * Set image
     *
     * @param MediaImage $image
     * @return PressRelease
     */
    public function setImage(MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set institution
     *
     * @param Institution $institution
     * @return PressRelease
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

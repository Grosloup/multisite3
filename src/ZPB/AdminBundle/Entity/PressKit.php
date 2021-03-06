<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PressKit
 *
 * @ORM\Table(name="zpb_press_kits")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PressKitRepository")
 */
class PressKit
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
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank(message="Ce champs est requis.")
     */
    private $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="image", type="integer")
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="pdf_fr_id", type="integer")
     */
    private $pdfFr;

    /**
     * @var integer
     *
     * @ORM\Column(name="pdf_en_id", type="integer")
     */
    private $pdfEn;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Institution", inversedBy="pressKits")
     * @ORM\JoinColumn(name="institution_id")
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
     * @return PressKit
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
     * @return PressKit
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
     * @return PressKit
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
     * @return PressKit
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
     * @return PressKit
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
     * Set image
     *
     * @param integer $image
     * @return PressKit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return integer 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set pdfFr
     *
     * @param integer $pdfFr
     * @return PressKit
     */
    public function setPdfFr($pdfFr)
    {
        $this->pdfFr = $pdfFr;

        return $this;
    }

    /**
     * Get pdfFr
     *
     * @return integer 
     */
    public function getPdfFr()
    {
        return $this->pdfFr;
    }

    /**
     * Set pdfEn
     *
     * @param integer $pdfEn
     * @return PressKit
     */
    public function setPdfEn($pdfEn)
    {
        $this->pdfEn = $pdfEn;

        return $this;
    }

    /**
     * Get pdfEn
     *
     * @return integer 
     */
    public function getPdfEn()
    {
        return $this->pdfEn;
    }

    /**
     * Set institution
     *
     * @param Institution $institution
     * @return PressKit
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

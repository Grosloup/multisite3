<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Institution
 *
 * @ORM\Table(name="zpb_institutions")
 * @UniqueEntity("name", message="Une institution porte déjà ce nom.")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\InstitutionRepository")
 */
class Institution
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="host", type="string", length=255, nullable=true)
     */
    private $host;

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
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\PhotoCategory", mappedBy="institution")
     */
    private $photoCategories;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\FAQ", mappedBy="institution")
     */
    private $faqs;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\MediaPdf", mappedBy="institution")
     */
    private $pdfs;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\PressRelease", mappedBy="institution")
     */
    private $pressReleases;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\PressKit", mappedBy="institution")
     */
    private $pressKits;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photoCategories = new ArrayCollection();
        $this->faqs = new ArrayCollection();
        $this->pdfs = new ArrayCollection();
        $this->pressReleases = new ArrayCollection();
        $this->pressKits = new ArrayCollection();
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
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     * @return Institution
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Institution
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set slug
     *
     * @param string $slug
     * @return Institution
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * @return Institution
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
     * @return Institution
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
     * @return Institution
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add photoCategories
     *
     * @param PhotoCategory $photoCategories
     * @return Institution
     */
    public function addPhotoCategory(PhotoCategory $photoCategories)
    {
        $this->photoCategories[] = $photoCategories;

        return $this;
    }

    /**
     * Remove photoCategories
     *
     * @param PhotoCategory $photoCategories
     */
    public function removePhotoCategory(PhotoCategory $photoCategories)
    {
        $this->photoCategories->removeElement($photoCategories);
    }

    /**
     * Get photoCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotoCategories()
    {
        return $this->photoCategories;
    }

    public function hasPhotoCategories()
    {
        return count($this->getPhotoCategories()) > 0;
    }

    public function hasFaqs()
    {
        return count($this->getFaqs()) > 0;
    }

    /**
     * Add faqs
     *
     * @param FAQ $faqs
     * @return Institution
     */
    public function addFaq(FAQ $faqs)
    {
        $this->faqs[] = $faqs;

        return $this;
    }

    /**
     * Remove faqs
     *
     * @param FAQ $faqs
     */
    public function removeFaq(FAQ $faqs)
    {
        $this->faqs->removeElement($faqs);
    }

    /**
     * Get faqs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFaqs()
    {
        return $this->faqs;
    }

    /**
     * Add pdfs
     *
     * @param MediaPdf $pdfs
     * @return Institution
     */
    public function addPdf(MediaPdf $pdfs)
    {
        $this->pdfs[] = $pdfs;

        return $this;
    }

    /**
     * Remove pdfs
     *
     * @param MediaPdf $pdfs
     */
    public function removePdf(MediaPdf $pdfs)
    {
        $this->pdfs->removeElement($pdfs);
    }

    /**
     * Get pdfs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPdfs()
    {
        return $this->pdfs;
    }

    /**
     * Add pressReleases
     *
     * @param PressRelease $pressReleases
     * @return Institution
     */
    public function addPressRelease(PressRelease $pressReleases)
    {
        $this->pressReleases[] = $pressReleases;

        return $this;
    }

    /**
     * Get pressReleases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressReleases()
    {
        return $this->pressReleases;
    }

    /**
     * Add pressKits
     *
     * @param PressKit $pressKits
     * @return Institution
     */
    public function addPressKit(PressKit $pressKits)
    {
        $this->pressKits[] = $pressKits;

        return $this;
    }

    /**
     * Remove pressKits
     *
     * @param PressKit $pressKits
     */
    public function removePressKit(PressKit $pressKits)
    {
        $this->pressKits->removeElement($pressKits);
    }

    /**
     * Get pressKits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressKits()
    {
        return $this->pressKits;
    }

    /**
     * Remove pressReleases
     *
     * @param PressRelease $pressReleases
     */
    public function removePressRelease(PressRelease $pressReleases)
    {
        $this->pressReleases->removeElement($pressReleases);
    }
}

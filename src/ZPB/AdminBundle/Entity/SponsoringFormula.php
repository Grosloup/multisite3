<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * SponsoringFormula
 *
 * @ORM\Table(name="zpb_sponsoring_formulas")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\SponsoringFormulaRepository")
 */
class SponsoringFormula
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"}, unique=true)
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
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var float
     *
     * @ORM\Column(name="taxFreePrice", type="float", nullable=false)
     */
    private $taxFreePrice;

    /**
     * @var float
     *
     * @ORM\Column(name="taxRate", type="float", nullable=false)
     */
    private $taxRate;

    /**
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="longDescription", type="text", nullable=false)
     */
    private $longDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="shortDescription", type="text", nullable=false)
     */
    private $shortDescription;


    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\SponsoringGiftDefinition", inversedBy="formulas")
     * @ORM\JoinTable(name="zpb_sponsoring_formulas_gifts")
     */
    private $giftDefinitions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->giftDefinitions = new ArrayCollection();
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
     * @return SponsoringFormula
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $price
     * @return SponsoringFormula
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
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
     * @return SponsoringFormula
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
     * @return SponsoringFormula
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
     * @return SponsoringFormula
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return SponsoringFormula
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get taxFreePrice
     *
     * @return float
     */
    public function getTaxFreePrice()
    {
        return $this->taxFreePrice;
    }

    /**
     * Set taxFreePrice
     *
     * @param float $taxFreePrice
     * @return SponsoringFormula
     */
    public function setTaxFreePrice($taxFreePrice)
    {
        $this->taxFreePrice = $taxFreePrice;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set taxRate
     *
     * @param float $taxRate
     * @return SponsoringFormula
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return SponsoringFormula
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return SponsoringFormula
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Add giftDefinitions
     *
     * @param SponsoringGiftDefinition $giftDefinitions
     * @return SponsoringFormula
     */
    public function addGiftDefinitions(SponsoringGiftDefinition $giftDefinitions)
    {
        $this->giftDefinitions[] = $giftDefinitions;

        return $this;
    }

    /**
     * Remove giftDefinitions
     *
     * @param SponsoringGiftDefinition $giftDefinitions
     */
    public function removeGiftDefinitions(SponsoringGiftDefinition $giftDefinitions)
    {
        $this->giftDefinitions->removeElement($giftDefinitions);
    }

    /**
     * Get giftDefinitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGiftDefinitions()
    {
        return $this->giftDefinitions;
    }
}

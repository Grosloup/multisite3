<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SponsoringGiftDefinition
 *
 * @ORM\Table(name="zpb_sponsoring_gifts_descriptions")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\SponsoringGiftDefinitionRepository")
 */
class SponsoringGiftDefinition
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
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="longDescription", type="text")
     */
    private $longDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="shortDescription", type="text")
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="legend", type="string", length=255)
     */
    private $legend;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="positionGroup", type="string", length=255)
     */
    private $positionGroup;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\SponsoringFormula", mappedBy="giftDesriptions")
     */
    private $formulas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formulas = new ArrayCollection();
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
     * @return SponsoringGiftDefinition
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
     * @return SponsoringGiftDefinition
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * @return SponsoringGiftDefinition
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
     * @return SponsoringGiftDefinition
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

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
     * Set legend
     *
     * @param string $legend
     * @return SponsoringGiftDefinition
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

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
     * @return SponsoringGiftDefinition
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
     * @return SponsoringGiftDefinition
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
     * @return SponsoringGiftDefinition
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get positionGroup
     *
     * @return string
     */
    public function getPositionGroup()
    {
        return $this->positionGroup;
    }

    /**
     * Set positionGroup
     *
     * @param string $positionGroup
     * @return SponsoringGiftDefinition
     */
    public function setPositionGroup($positionGroup)
    {
        $this->positionGroup = $positionGroup;

        return $this;
    }

    /**
     * Add formulas
     *
     * @param SponsoringFormula $formulas
     * @return SponsoringGiftDefinition
     */
    public function addFormula(SponsoringFormula $formulas)
    {
        $this->formulas[] = $formulas;

        return $this;
    }

    /**
     * Remove formulas
     *
     * @param SponsoringFormula $formulas
     */
    public function removeFormula(SponsoringFormula $formulas)
    {
        $this->formulas->removeElement($formulas);
    }

    /**
     * Get formulas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormulas()
    {
        return $this->formulas;
    }
}

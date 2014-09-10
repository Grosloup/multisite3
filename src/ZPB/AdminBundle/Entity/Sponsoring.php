<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sponsoring
 *
 * @ORM\Table(name="zpb_sponsorings")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\SponsoringRepository")
 */
class Sponsoring
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     * @Gedmo\Slug(fields={"name"})
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
     * @ORM\Column(name="start_at", type="datetime")
     *
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime")
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Godparent", inversedBy="sponsorings")
     * @ORM\JoinColumn(name="godparent_id", referencedColumnName="id")
     */
    private $godparent;

    /**
     * @ORM\Column(name="type", type="string", length=100, nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\SponsoringFormula", inversedBy="sponsorings")
     * @ORM\JoinColumn(name="formula_id", referencedColumnName="id")
     */
    private $formula;

    /**
     * @ORM\Column(name="is_present", type="boolean", nullable=false)
     */
    private $isPresent;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @ORM\Column(name="delayed_at", type="datetime", nullable=true)
     */
    private $delayedAt;

    public function __construct()
    {
        $this->isPresent = false;
        $this->isActive = true;
    }

    /**
     * @return mixed
     */
    public function getDelayedAt()
    {
        return $this->delayedAt;
    }

    /**
     * @param mixed $delayedAt
     * @return Sponsoring
     */
    public function setDelayedAt($delayedAt)
    {
        $this->delayedAt = $delayedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return Sponsoring
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
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
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Sponsoring
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }



    /**
     * Set name
     *
     * @param string $name
     * @return Sponsoring
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set slug
     *
     * @param string $slug
     * @return Sponsoring
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
     * @return Sponsoring
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
     * Set startAt
     *
     * @param \DateTime $startAt
     * @return Sponsoring
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Sponsoring
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set godparent
     *
     * @param Godparent $godparent
     * @return Sponsoring
     */
    public function setGodparent(Godparent $godparent = null)
    {
        $this->godparent = $godparent;

        return $this;
    }

    /**
     * Get godparent
     *
     * @return Godparent
     */
    public function getGodparent()
    {
        return $this->godparent;
    }

    /**
     * Set formula
     *
     * @param SponsoringFormula $formula
     * @return Sponsoring
     */
    public function setFormula(SponsoringFormula $formula = null)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get formula
     *
     * @return SponsoringFormula
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * Set isPresent
     *
     * @param boolean $isPresent
     * @return Sponsoring
     */
    public function setIsPresent($isPresent)
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    /**
     * Get isPresent
     *
     * @return boolean 
     */
    public function getIsPresent()
    {
        return $this->isPresent;
    }
}

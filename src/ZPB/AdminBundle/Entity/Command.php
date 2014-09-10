<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Command
 *
 * @ORM\Table(name="zpb_commands")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\CommandRepository")
 */
class Command
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="def_id", type="string", length=255)
     */
    private $defId;

    /**
     * @var string
     *
     * @ORM\Column(name="tmp_id", type="string", length=255)
     */
    private $tmpId;

    /**
     * @var float
     *
     * @ORM\Column(name="total_amount", type="float")
     */
    private $totalAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="total_amount_ttc", type="float")
     */
    private $totalAmountTtc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_valid", type="boolean")
     */
    private $isValid;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\CommandItemSponsor", mappedBy="command")
     */
    private $sponsorings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sponsorings = new ArrayCollection();
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
     * @return Command
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get defId
     *
     * @return string
     */
    public function getDefId()
    {
        return $this->defId;
    }

    /**
     * Set defId
     *
     * @param string $defId
     * @return Command
     */
    public function setDefId($defId)
    {
        $this->defId = $defId;

        return $this;
    }

    /**
     * Get tmpId
     *
     * @return string
     */
    public function getTmpId()
    {
        return $this->tmpId;
    }

    /**
     * Set tmpId
     *
     * @param string $tmpId
     * @return Command
     */
    public function setTmpId($tmpId)
    {
        $this->tmpId = $tmpId;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     * @return Command
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmountTtc
     *
     * @return float
     */
    public function getTotalAmountTtc()
    {
        return $this->totalAmountTtc;
    }

    /**
     * Set totalAmountTtc
     *
     * @param float $totalAmountTtc
     * @return Command
     */
    public function setTotalAmountTtc($totalAmountTtc)
    {
        $this->totalAmountTtc = $totalAmountTtc;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * Set isValid
     *
     * @param boolean $isValid
     * @return Command
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Add sponsorings
     *
     * @param CommandItemSponsor $sponsorings
     * @return Command
     */
    public function addSponsoring(CommandItemSponsor $sponsorings)
    {
        $this->sponsorings[] = $sponsorings;

        return $this;
    }

    /**
     * Remove sponsorings
     *
     * @param CommandItemSponsor $sponsorings
     */
    public function removeSponsoring(CommandItemSponsor $sponsorings)
    {
        $this->sponsorings->removeElement($sponsorings);
    }

    /**
     * Get sponsorings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsorings()
    {
        return $this->sponsorings;
    }
}

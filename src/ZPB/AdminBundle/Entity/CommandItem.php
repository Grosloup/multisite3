<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CommandItemSponsor
 *
 * @ORM\Table(name="zpb_command_items")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\CommandItemRepository")
 */
class CommandItem implements CommandItemInterface
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
     * @var float
     *
     * @ORM\Column(name="amount_ht", type="float")
     */
    private $amountHt;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_ttc", type="float")
     */
    private $amountTtc;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float")
     */
    private $tva;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_present", type="boolean")
     */
    private $isPresent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Command", inversedBy="commandItems")
     * @ORM\JoinColumn(name="command_id", referencedColumnName="id")
     */
    private $command;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\SponsoringFormula")
     * @ORM\JoinColumn(name="formula_id", referencedColumnName="id")
     */
    private $formula;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Godparent")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $godparent;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Animal")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animal;

    /**
     * @ORM\Column(name="delayed_at", type="datetime",nullable=true)
     */
    private $delayed_at;

    public function __construct()
    {
        $this->isPresent = false;
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
     * Get amountHt
     *
     * @return float
     */
    public function getAmountHt()
    {
        return $this->amountHt;
    }

    /**
     * Set amountHt
     *
     * @param float $amountHt
     * @return CommandItemSponsor
     */
    public function setAmountHt($amountHt)
    {
        $this->amountHt = $amountHt;

        return $this;
    }

    /**
     * Get amountTtc
     *
     * @return float
     */
    public function getAmountTtc()
    {
        return $this->amountTtc;
    }

    /**
     * Set amountTtc
     *
     * @param float $amountTtc
     * @return CommandItemSponsor
     */
    public function setAmountTtc($amountTtc)
    {
        $this->amountTtc = $amountTtc;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set tva
     *
     * @param float $tva
     * @return CommandItemSponsor
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

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

    /**
     * Set isPresent
     *
     * @param boolean $isPresent
     * @return CommandItemSponsor
     */
    public function setIsPresent($isPresent)
    {
        $this->isPresent = $isPresent;

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
     * @return CommandItemSponsor
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get command
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set command
     *
     * @param Command $command
     * @return CommandItemSponsor
     */
    public function setCommand(Command $command = null)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Set delayed_at
     *
     * @param \DateTime $delayedAt
     * @return CommandItemSponsor
     */
    public function setDelayedAt($delayedAt)
    {
        $this->delayed_at = $delayedAt;

        return $this;
    }

    /**
     * Get delayed_at
     *
     * @return \DateTime
     */
    public function getDelayedAt()
    {
        return $this->delayed_at;
    }

    /**
     * Set formula
     *
     * @param SponsoringFormula $formula
     * @return CommandItemSponsor
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
     * Set godparent
     *
     * @param Godparent $godparent
     * @return CommandItemSponsor
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
     * Set animal
     *
     * @param Animal $animal
     * @return CommandItemSponsor
     */
    public function setAnimal(Animal $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }
}

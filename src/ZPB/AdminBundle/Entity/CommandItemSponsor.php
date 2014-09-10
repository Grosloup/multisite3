<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CommandItemSponsor
 *
 * @ORM\Table(name="zpb_command_items_sponsoring")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\CommandItemSponsorRepository")
 */
class CommandItemSponsor implements CommandItemInterface
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
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Command", inversedBy="sponsorings")
     * @ORM\JoinColumn(name="command_id", referencedColumnName="id")
     */
    private $command;


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
}

<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandItemSponsor
 *
 * @ORM\Table()
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
     */
    private $createdAt;


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
     * Get amountHt
     *
     * @return float 
     */
    public function getAmountHt()
    {
        return $this->amountHt;
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
     * Get amountTtc
     *
     * @return float 
     */
    public function getAmountTtc()
    {
        return $this->amountTtc;
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
     * Get tva
     *
     * @return float 
     */
    public function getTva()
    {
        return $this->tva;
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
     * Get isPresent
     *
     * @return boolean 
     */
    public function getIsPresent()
    {
        return $this->isPresent;
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
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

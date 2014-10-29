<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AnimationProgram
 *
 * @ORM\Table(name="zpb_animations_programs")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimationProgramRepository")
 */
class AnimationProgram
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
     * @ORM\Column(name="daytime", type="date")
     */
    private $daytime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_off", type="boolean")
     */
    private $isOff;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\AnimationDay", inversedBy="animationPrograms")
     * @ORM\JoinTable(name="zpb_animations_prog_day")
     */
    private $animationDays;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animationDays = new ArrayCollection();
        $this->isOff = false;
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
     * Get isOff
     *
     * @return boolean
     */
    public function getIsOff()
    {
        return $this->isOff;
    }

    /**
     * Set isOff
     *
     * @param boolean $isOff
     * @return AnimationProgram
     */
    public function setIsOff($isOff)
    {
        $this->isOff = $isOff;

        return $this;
    }

    /**
     * Add animationDays
     *
     * @param AnimationDay $animationDays
     * @return AnimationProgram
     */
    public function addAnimationDay(AnimationDay $animationDays)
    {
        $this->animationDays[] = $animationDays;

        return $this;
    }

    /**
     * Remove animationDays
     *
     * @param AnimationDay $animationDays
     */
    public function removeAnimationDay(AnimationDay $animationDays)
    {
        $this->animationDays->removeElement($animationDays);
    }

    /**
     * Get animationDays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimationDays()
    {
        return $this->animationDays;
    }

    /**
     * Set daytime
     *
     * @param \DateTime $daytime
     * @return AnimationProgram
     */
    public function setDaytime($daytime)
    {
        $this->daytime = $daytime;

        return $this;
    }

    /**
     * Get daytime
     *
     * @return \DateTime 
     */
    public function getDaytime()
    {
        return $this->daytime;
    }
}

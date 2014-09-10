<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ZPB\AdminBundle\Validator\Constraints as ZPBAssert;

/**
 * AnimationDay
 *
 * @ORM\Table(name="zpb_animations_days")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimationDayRepository")
 */
class AnimationDay
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
     * @Assert\Regex("/^[)(a-zéèêëàâûüîïç@\/.,;: _-]*$/i",message="Seuls les caractères: a à z et éèêëàâûüîïç@/.,;: _-  sont autorisés")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     * @ZPBAssert\HexColor()
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\AnimationSchedule", mappedBy="animationDay")
     */
    private $schedules;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->color = "ffffff";
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
     * @return AnimationDay
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return AnimationDay
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Add schedules
     *
     * @param AnimationSchedule $schedules
     * @return AnimationDay
     */
    public function addSchedule(AnimationSchedule $schedules)
    {
        $this->schedules[] = $schedules;

        return $this;
    }

    /**
     * Remove schedules
     *
     * @param AnimationSchedule $schedules
     */
    public function removeSchedule(AnimationSchedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
}

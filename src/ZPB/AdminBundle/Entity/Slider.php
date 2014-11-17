<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Slider
 *
 * @ORM\Table(name="zpb_sliders")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\SliderRepository")
 */
class Slider
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
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=20, nullable=false)
     */
    private $institution;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Slide", mappedBy="slider")
     *
     */
    private $slides;

    /**
     * @var integer
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slides = new ArrayCollection();
        $this->duration = 10000;
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
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Slider
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get institution
     *
     * @return string
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set institution
     *
     * @param string $institution
     * @return Slider
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get slides
     *
     * @return string
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * Set slides
     *
     * @param string $slides
     * @return Slider
     */
    public function setSlides($slides)
    {
        $this->slides = $slides;

        return $this;
    }

    /**
     * Add slides
     *
     * @param Slide $slides
     * @return Slider
     */
    public function addSlide(Slide $slides)
    {
        $this->slides[] = $slides;

        return $this;
    }

    /**
     * Remove slides
     *
     * @param Slide $slides
     */
    public function removeSlide(Slide $slides)
    {
        $this->slides->removeElement($slides);
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Slider
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }


}

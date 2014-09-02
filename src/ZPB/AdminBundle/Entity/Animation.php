<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Animation
 *
 * @ORM\Table(name="zpb_animations")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimationRepository")
 */
class Animation
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="place_number", type="string", length=20)
     */
    private $placeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="place_name", type="string", length=255)
     */
    private $placeName;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\AnimationSchedule", mappedBy="animation")
     */
    private $schedules;


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
     * Set name
     *
     * @param string $name
     * @return Animation
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
     * @return Animation
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
     * Set description
     *
     * @param string $description
     * @return Animation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set placeNumber
     *
     * @param string $placeNumber
     * @return Animation
     */
    public function setPlaceNumber($placeNumber)
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }

    /**
     * Get placeNumber
     *
     * @return string 
     */
    public function getPlaceNumber()
    {
        return $this->placeNumber;
    }

    /**
     * Set placeName
     *
     * @param string $placeName
     * @return Animation
     */
    public function setPlaceName($placeName)
    {
        $this->placeName = $placeName;

        return $this;
    }

    /**
     * Get placeName
     *
     * @return string 
     */
    public function getPlaceName()
    {
        return $this->placeName;
    }
}

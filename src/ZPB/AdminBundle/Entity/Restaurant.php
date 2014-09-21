<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Restaurant
 *
 * @ORM\Table(name="zpb_restaurants")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\RestaurantRepository")
 * @UniqueEntity("name", message="Ce nom est déjà utilisé.")
 */
class Restaurant
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Ce champs est requis.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     * @Assert\NotBlank(message="Ce champs est requis.")
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_open", type="boolean", nullable=false)
     */
    private $isOpen;

    /**
     * @var string
     *
     * @ORM\Column(name="mapNum", type="string", length=3, nullable=false)
     * @Assert\NotBlank(message="Ce champs est requis.")
     */
    private $mapNum;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="ZPB\AdminBundle\Entity\MediaImage")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $visuel;

    /**
     * @var string
     *
     * @ORM\Column(name="long_id", type="string", length=20, nullable=false)
     */
    private $longId;

    public function __construct()
    {
        $this->isOpen = false;
        $longId = md5(
            (new \DateTime('now', new \DateTimeZone('Europe/Paris')))->getTimestamp() . uniqid(mt_rand(), true)
        );
        $this->longId = substr($longId, 0, 8);
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
     * Set name
     *
     * @param string $name
     * @return Restaurant
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
     * Set description
     *
     * @param string $description
     * @return Restaurant
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
     * Set isOpen
     *
     * @param boolean $isOpen
     * @return Restaurant
     */
    public function setIsOpen($isOpen)
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * Get isOpen
     *
     * @return boolean
     */
    public function getIsOpen()
    {
        return $this->isOpen;
    }

    /**
     * Set mapNum
     *
     * @param string $mapNum
     * @return Restaurant
     */
    public function setMapNum($mapNum)
    {
        $this->mapNum = $mapNum;

        return $this;
    }

    /**
     * Get mapNum
     *
     * @return string
     */
    public function getMapNum()
    {
        return $this->mapNum;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Restaurant
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
     * Set visuel
     *
     * @param MediaImage $visuel
     * @return Restaurant
     */
    public function setVisuel(MediaImage $visuel = null)
    {
        $this->visuel = $visuel;

        return $this;
    }

    /**
     * Get visuel
     *
     * @return MediaImage
     */
    public function getVisuel()
    {
        return $this->visuel;
    }

    /**
     * @return string
     */
    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * @param string $longId
     * @return Restaurant
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;
        return $this;
    }

    function __toString()
    {
        return $this->name;
    }


}

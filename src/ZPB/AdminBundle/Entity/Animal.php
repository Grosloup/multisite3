<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Animal
 *
 * @ORM\Table(name="zpb_animals")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimalRepository")
 */
class Animal
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
     */
    private $name;
    /**
     * @ORM\Column(name="slug", type="string", nullable=false, unique=true, length=255)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="long_name", type="string", length=255, nullable=false)
     */
    private $longName;
    /**
     * @ORM\Column(name="canonical_long_name", type="string", length=255, nullable=false)
     * @Gedmo\Slug(fields={"longName"}, unique=true)
     */
    private $canonicalLongName;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="born_at", type="datetime", nullable=false)
     */
    private $bornAt;

    /**
     * @ORM\Column(name="born_in", type="string", length=255, nullable=true)
     */
    private $bornIn;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    private $sex;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\AnimalSpecies", inversedBy="animals")
     * @ORM\JoinColumn(name="species_id", referencedColumnName="id")
     */
    private $species;
    /**
     * @ORM\Column(name="long_description", type="text", nullable=false)
     */
    private $longDescription;
    /**
     * @ORM\Column(name="short_description", type="text", nullable=false)
     */
    private $shortDescription;
    /**
     * @ORM\Column(name="history", type="text")
     */
    private $history;
    /**
     * @ORM\Column(name="is_available", type="boolean")
     */
    private $isAvailable;
    /**
     * @ORM\Column(name="is_archived", type="boolean")
     */
    private $isArchived;
    /**
     * @ORM\Column(name="is_dropped", type="boolean")
     */
    private $isDropped;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\AnimalCategory", inversedBy="animals")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    public function __construct()
    {
        $this->setIsAvailable(true);
        $this->setIsArchived(false);
        $this->setIsDropped(false);
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
     * @return Animal
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Animal
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

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
     * Set slug
     *
     * @param string $slug
     * @return Animal
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get longName
     *
     * @return string
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Set longName
     *
     * @param string $longName
     * @return Animal
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;

        return $this;
    }

    /**
     * Get canonicalLongName
     *
     * @return string
     */
    public function getCanonicalLongName()
    {
        return $this->canonicalLongName;
    }

    /**
     * Set canonicalLongName
     *
     * @param string $canonicalLongName
     * @return Animal
     */
    public function setCanonicalLongName($canonicalLongName)
    {
        $this->canonicalLongName = $canonicalLongName;

        return $this;
    }

    /**
     * Get bornIn
     *
     * @return string
     */
    public function getBornIn()
    {
        return $this->bornIn;
    }

    /**
     * Set bornIn
     *
     * @param string $bornIn
     * @return Animal
     */
    public function setBornIn($bornIn)
    {
        $this->bornIn = $bornIn;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return Animal
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Animal
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get history
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set history
     *
     * @param string $history
     * @return Animal
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return Animal
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isArchived
     *
     * @return boolean
     */
    public function getIsArchived()
    {
        return $this->isArchived;
    }

    /**
     * Set isArchived
     *
     * @param boolean $isArchived
     * @return Animal
     */
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * Get isDropped
     *
     * @return boolean
     */
    public function getIsDropped()
    {
        return $this->isDropped;
    }

    /**
     * Set isDropped
     *
     * @param boolean $isDropped
     * @return Animal
     */
    public function setIsDropped($isDropped)
    {
        $this->isDropped = $isDropped;

        return $this;
    }

    /**
     * Get species
     *
     * @return AnimalSpecies
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set species
     *
     * @param AnimalSpecies $species
     * @return Animal
     */
    public function setSpecies(AnimalSpecies $species = null)
    {
        $this->species = $species;

        return $this;
    }

    public function getAge()
    {
        $today = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $todayYear = $today->format("Y");
        $birthYear = $this->getBornAt()->format("Y");
        $years = $todayYear - $birthYear;
        if ($years < 1) {
            return 'Moins d\'un an';
        }
        if ($years == 1) {
            return '1 an';
        }

        return $years . ' ans';
    }

    /**
     * Get bornAt
     *
     * @return \DateTime
     */
    public function getBornAt()
    {
        return $this->bornAt;
    }

    /**
     * Set bornAt
     *
     * @param \DateTime $bornAt
     * @return Animal
     */
    public function setBornAt($bornAt)
    {
        $this->bornAt = $bornAt;

        return $this;
    }

    /**
     * Set category
     *
     * @param AnimalCategory $category
     * @return Animal
     */
    public function setCategory(AnimalCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return AnimalCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}

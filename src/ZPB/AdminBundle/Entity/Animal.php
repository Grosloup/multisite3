<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * @ORM\Column(name="slug", type="string", nullable=false;, unique=true, length=255)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;
    /**
     * @ORM\Column(name="canonical_name", type="string", length=255, nullable=false)
     * @Gedmo\Slug(fields={"canonicalName"}, unique=true)
     */
    private $canonicalName;
    /**
     * @var string
     *
     * @ORM\Column(name="long_name", type="string", length=255, nullable=false)
     */
    private $longName;
    /**
     * @ORM\Column(name="canonical_long_name", type="string", length=255, nullable=false)
     * @Gedmo\Slug(fields={"canonicalLongName"}, unique=true)
     */
    private $canonicalLongName;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="born_at", type="datetime")
     */
    private $bornAt;

    /**
     * @ORM\Column(name="born_in", type="string", length=255)
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
     * @ORM\Column(name="short_description", type="text")
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
     * @return Animal
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
     * Get bornAt
     *
     * @return \DateTime 
     */
    public function getBornAt()
    {
        return $this->bornAt;
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
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }
}

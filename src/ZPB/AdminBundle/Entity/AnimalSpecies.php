<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AnimalSpecies
 *
 * @ORM\Table(name="zpb_animal_species")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimalSpeciesRepository")
 * @UniqueEntity("name")
 */
class AnimalSpecies
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;
    /**
     * @ORM\Column(name="latin", type="string", length=255, nullable=false, unique=true)
     */
    private $latin;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Animal", mappedBy="species")
     */
    private $animals;

    private $habitat;

    private $geoDistribution;

    private $diet;

    private $size;

    private $weight;

    private $lifespan;
    /**
     * @ORM\Column(name="gestation", type="text", nullable=false)
     */
    private $gestation;
    /**
     * @ORM\Column(name="status_iucn", type="string", length=255, nullable=false)
     */
    private $statusIUCN;
    /**
     * @ORM\Column(name="genus", type="string", length=255, nullable=false)
     */
    private $genus;
    /**
     * @ORM\Column(name="classe", type="string", length=255, nullable=false)
     */
    private $classe;
    /**
     * @ORM\Column(name="family", type="string", length=255, nullable=false)
     */
    private $family;
    /**
     * @ORM\Column(name="animal_order", type="string", length=255, nullable=false)
     */
    private $animalOrder;
    /**
     * @ORM\Column(name="long_description", type="text", nullable=false)
     */
    private $longDescription;
    /**
     * @ORM\Column(name="short_description", type="text", nullable=false)
     */
    private $shortDescription;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animals = new ArrayCollection();
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
     * @return AnimalSpecies
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return AnimalSpecies
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get latin
     *
     * @return string
     */
    public function getLatin()
    {
        return $this->latin;
    }

    /**
     * Set latin
     *
     * @param string $latin
     * @return AnimalSpecies
     */
    public function setLatin($latin)
    {
        $this->latin = $latin;

        return $this;
    }

    /**
     * Get gestation
     *
     * @return string
     */
    public function getGestation()
    {
        return $this->gestation;
    }

    /**
     * Set gestation
     *
     * @param string $gestation
     * @return AnimalSpecies
     */
    public function setGestation($gestation)
    {
        $this->gestation = $gestation;

        return $this;
    }

    /**
     * Get statusIUCN
     *
     * @return string
     */
    public function getStatusIUCN()
    {
        return $this->statusIUCN;
    }

    /**
     * Set statusIUCN
     *
     * @param string $statusIUCN
     * @return AnimalSpecies
     */
    public function setStatusIUCN($statusIUCN)
    {
        $this->statusIUCN = $statusIUCN;

        return $this;
    }

    /**
     * Get genus
     *
     * @return string
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Set genus
     *
     * @param string $genus
     * @return AnimalSpecies
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set classe
     *
     * @param string $classe
     * @return AnimalSpecies
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get family
     *
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set family
     *
     * @param string $family
     * @return AnimalSpecies
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get animalOrder
     *
     * @return string
     */
    public function getAnimalOrder()
    {
        return $this->animalOrder;
    }

    /**
     * Set animalOrder
     *
     * @param string $animalOrder
     * @return AnimalSpecies
     */
    public function setAnimalOrder($animalOrder)
    {
        $this->animalOrder = $animalOrder;

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
     * @return AnimalSpecies
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
     * @return AnimalSpecies
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Add animals
     *
     * @param Animal $animals
     * @return AnimalSpecies
     */
    public function addAnimal(Animal $animals)
    {
        $this->animals[] = $animals;

        return $this;
    }

    /**
     * Remove animals
     *
     * @param Animal $animals
     */
    public function removeAnimal(Animal $animals)
    {
        $this->animals->removeElement($animals);
    }

    /**
     * Get animals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimals()
    {
        return $this->animals;
    }
}

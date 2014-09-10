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
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="longName", type="string", length=255, nullable=false)
     */
    private $longName;

    /**
     * @ORM\Column(name="canonicalLongName", type="string", length=255, nullable=false)
     * @Gedmo\Slug(fields={"longName"}, unique=true)
     */
    private $canonicalLongName;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     * @Assert\Regex("/^[a-zA-Z0-9_-]+$/", message="Ce champ contient des caractères non autorisés.")
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Animal", mappedBy="species")
     */
    private $animals;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="habitat", type="string", length=255, nullable=false)
     */
    private $habitat;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="geoDistribution", type="string", length=255, nullable=false)
     */
    private $geoDistribution;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="diet", type="text")
     */
    private $diet;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="size", type="string", length=255)
     */
    private $size;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="lifespan", type="string", length=255)
     */
    private $lifespan;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="gestation", type="string", nullable=false)
     */
    private $gestation;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="status_iucn", type="string", length=255, nullable=false)
     */
    private $statusIUCN;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="genus", type="string", length=255, nullable=false)
     */
    private $genus;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="classe", type="string", length=255, nullable=false)
     */
    private $classe;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="family", type="string", length=255, nullable=false)
     */
    private $family;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="animal_order", type="string", length=255, nullable=false)
     */
    private $animalOrder;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="long_description", type="text", nullable=false)
     */
    private $longDescription;
    /**
     * @Assert\NotBlank()
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
     * @return AnimalSpecies
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
     * @return AnimalSpecies
     */
    public function setCanonicalLongName($canonicalLongName)
    {
        $this->canonicalLongName = $canonicalLongName;

        return $this;
    }

    /**
     * Get habitat
     *
     * @return string
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set habitat
     *
     * @param string $habitat
     * @return AnimalSpecies
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get geoDistribution
     *
     * @return string
     */
    public function getGeoDistribution()
    {
        return $this->geoDistribution;
    }

    /**
     * Set geoDistribution
     *
     * @param string $geoDistribution
     * @return AnimalSpecies
     */
    public function setGeoDistribution($geoDistribution)
    {
        $this->geoDistribution = $geoDistribution;

        return $this;
    }

    /**
     * Get diet
     *
     * @return string
     */
    public function getDiet()
    {
        return $this->diet;
    }

    /**
     * Set diet
     *
     * @param string $diet
     * @return AnimalSpecies
     */
    public function setDiet($diet)
    {
        $this->diet = $diet;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return AnimalSpecies
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return AnimalSpecies
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get lifespan
     *
     * @return string
     */
    public function getLifespan()
    {
        return $this->lifespan;
    }

    /**
     * Set lifespan
     *
     * @param string $lifespan
     * @return AnimalSpecies
     */
    public function setLifespan($lifespan)
    {
        $this->lifespan = $lifespan;

        return $this;
    }
}

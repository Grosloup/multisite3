<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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

    private $gestation;

    private $statusIUCN;

    private $genus;

    private $classe;

    private $family;

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
     * @return AnimalSpecies
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
     * @return AnimalSpecies
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
}

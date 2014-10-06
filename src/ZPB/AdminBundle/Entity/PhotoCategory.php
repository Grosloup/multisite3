<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PhotoCategory
 *
 * @ORM\Table(name="zpb_phototek_categories")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PhotoCategoryRepository")
 * @UniqueEntity("name", message="Une catégorie de photo porte déjà ce nom.")
 */
class PhotoCategory
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
     * @Assert\NotBlank(message="Ce champs ne doit pas être vide.")
     * @Assert\Regex("/^[)(a-zA-Z0-9éèêëàâôöûüîïç@#&',.\/!?:_ -]+$/i", message="Ce champs contient des caractères non autorisés.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creatde_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $creatdeAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var string
     * @Assert\Regex("[a-zA-Z0-9éèêëàçâûüîïôö,;.?!&\'\"\/:+*_ -]*", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Photo", mappedBy="category")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Photo", mappedBy="category")
     */
    private $photosHd;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Institution", inversedBy="photoCategories")
     * @ORM\JoinColumn(name="institution_id")
     */
    private $institution;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->photosHd = new ArrayCollection();
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
     * @return PhotoCategory
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
     * @return PhotoCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get creatdeAt
     *
     * @return \DateTime
     */
    public function getCreatdeAt()
    {
        return $this->creatdeAt;
    }

    /**
     * Set creatdeAt
     *
     * @param \DateTime $creatdeAt
     * @return PhotoCategory
     */
    public function setCreatdeAt($creatdeAt)
    {
        $this->creatdeAt = $creatdeAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return PhotoCategory
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
     * Set description
     *
     * @param string $description
     * @return PhotoCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Add photos
     *
     * @param Photo $photos
     * @return PhotoCategory
     */
    public function addPhoto(Photo $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param Photo $photos
     */
    public function removePhoto(Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add photosHd
     *
     * @param PhotoHd $photosHd
     * @return PhotoCategory
     */
    public function addPhotoHd(PhotoHd $photosHd)
    {
        $this->photosHd[] = $photosHd;

        return $this;
    }

    /**
     * Remove photosHd
     *
     * @param PhotoHd $photosHd
     */
    public function removePhotoHd(PhotoHd $photosHd)
    {
        $this->photosHd->removeElement($photosHd);
    }

    /**
     * Get photosHd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotosHd()
    {
        return $this->photosHd;
    }


    /**
     * Set institution
     *
     * @param Institution $institution
     * @return PhotoCategory
     */
    public function setInstitution(Institution $institution = null)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return Institution
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    function __toString()
    {
        return $this->name;
    }

    public function hasPhotos()
    {
        return count($this->getPhotos()) > 0;
    }
}

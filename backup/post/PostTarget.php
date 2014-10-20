<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PostTarget
 *
 * @ORM\Table(name="zpb_post_targets")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PostTargetRepository")
 * @UniqueEntity("name", message="Un site cible existe déjà sous ce nom.")
 * @ORM\HasLifecycleCallbacks()
 */
class PostTarget
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
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="front_post_id", type="string", length=255, nullable=true)
     */
    private $frontPostId;

    /**
     * @ORM\Column(name="acrornym", type="string", length=20, nullable=false, unique=true)
     */
    private $acronym;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\Post", mappedBy="targets")
     */
    private $posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist()
     */
    public function createAcronym()
    {
        $name = mb_strtolower($this->name, 'UTF-8');
        //$name = str_replace(['l', '\'', '"', 'd', '-', '_', 'a', 'à', 'au','aux','de','des','du','la','le','les'], ' ',);
        $name = preg_replace(
            '/(^|\s+)(l\'|les?|la|d\'|des?|du|à|a|aux?|_|\-|"|ces?|ça|ses?|sa|et|car|ou|où|or|ni|ne|donc|leurs?|vos|votre|nos|notre)/',
            ' ',
            $name
        );
        $name = preg_replace('/\s+/', ' ', $name);
        $words = explode(' ', $name);
        $this->acronym = '';
        foreach ($words as $w) {
            $this->acronym .= substr($w, 0, 1);
        }
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
     * @return PostTarget
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
     * @return PostTarget
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get frontPostId
     *
     * @return integer
     */
    public function getFrontPostId()
    {
        return $this->frontPostId;
    }

    /**
     * Set frontPostId
     *
     * @param integer $frontPostId
     * @return PostTarget
     */
    public function setFrontPostId($frontPostId)
    {
        $this->frontPostId = $frontPostId;

        return $this;
    }

    /**
     * Add posts
     *
     * @param Post $posts
     * @return PostTarget
     */
    public function addPost(Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param Post $posts
     */
    public function removePost(Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * @param mixed $acronym
     * @return PostTarget
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }


}

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
 *
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
}

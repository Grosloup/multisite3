<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="zpb_posts")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PostRepository")
 */
class Post
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
     * @ORM\Column(name="long_id", type="string",length=255, nullable=false, unique=true)
     */
    private $longId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"title"}, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text")
     */
    private $excerpt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dropped_at", type="datetime", nullable=true)
     */
    private $droppedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="archived_at", type="datetime", nullable=true)
     */
    private $archivedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_published", type="boolean")
     */
    private $isPublished;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_archived", type="boolean")
     */
    private $isArchived;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_draft", type="boolean")
     */
    private $isDraft;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_dropped", type="boolean")
     */
    private $isDropped;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\PostTarget", inversedBy="posts")
     * @ORM\JoinTable(name="zpb_posts_targets")
     */
    private $targets;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\PostCategory", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\PostTag", inversedBy="posts")
     * @ORM\JoinTable(name="zpb_posts_tags")
     */
    private $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->targets = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->isDraft = true;
        $this->isDropped = false;
        $this->isArchived = false;
        $this->isPublished = false;
        $longId = md5((new \DateTime('now', new \DateTimeZone('Europe/Paris')))->getTimestamp() . uniqid(mt_rand(), true));
        $this->longId = substr($longId, 0, 8);
    }

    public function getStatus()
    {
        if($this->isArchived){
            return 'Archivé';
        }
        if($this->isPublished){
            return 'Publié';
        }
        if($this->isDropped){
            return 'Encorbeillé';
        }
        return  'Brouillon';
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
     * @return string
     */
    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * @param string $longId
     * @return Post
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return Post
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get droppedAt
     *
     * @return \DateTime
     */
    public function getDroppedAt()
    {
        return $this->droppedAt;
    }

    /**
     * Set droppedAt
     *
     * @param \DateTime $droppedAt
     * @return Post
     */
    public function setDroppedAt($droppedAt)
    {
        $this->droppedAt = $droppedAt;

        return $this;
    }

    /**
     * Get archivedAt
     *
     * @return \DateTime
     */
    public function getArchivedAt()
    {
        return $this->archivedAt;
    }

    /**
     * Set archivedAt
     *
     * @param \DateTime $archivedAt
     * @return Post
     */
    public function setArchivedAt($archivedAt)
    {
        $this->archivedAt = $archivedAt;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Post
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

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
     * @return Post
     */
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * Get isDraft
     *
     * @return boolean
     */
    public function getIsDraft()
    {
        return $this->isDraft;
    }

    /**
     * Set isDraft
     *
     * @param boolean $isDraft
     * @return Post
     */
    public function setIsDraft($isDraft)
    {
        $this->isDraft = $isDraft;

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
     * @return Post
     */
    public function setIsDropped($isDropped)
    {
        $this->isDropped = $isDropped;

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
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Add targets
     *
     * @param PostTarget $targets
     * @return Post
     */
    public function addTarget(PostTarget $targets)
    {
        $this->targets[] = $targets;

        return $this;
    }

    /**
     * Remove targets
     *
     * @param PostTarget $targets
     */
    public function removeTarget(PostTarget $targets)
    {
        $this->targets->removeElement($targets);
    }

    /**
     * Get targets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTargets()
    {
        return $this->targets;
    }

    /**
     * Set category
     *
     * @param PostCategory $category
     * @return Post
     */
    public function setCategory(PostCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return PostCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add tags
     *
     * @param PostTag $tags
     * @return Post
     */
    public function addTag(PostTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param PostTag $tags
     */
    public function removeTag(PostTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}

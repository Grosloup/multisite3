<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostImg
 *
 * @ORM\Table(name="zpb_posts_front_imgs")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PostImgRepository")
 */
class PostImg
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
     * @var integer
     *
     * @ORM\Column(name="post_long_id", type="integer")
     */
    private $postLongId;

    /**
     * @var integer
     *
     * @ORM\Column(name="img_id", type="integer")
     */
    private $imgId;


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
     * Set postLongId
     *
     * @param integer $postLongId
     * @return PostImg
     */
    public function setPostLongId($postLongId)
    {
        $this->postLongId = $postLongId;

        return $this;
    }

    /**
     * Get postLongId
     *
     * @return integer
     */
    public function getPostLongId()
    {
        return $this->postLongId;
    }

    /**
     * Set imgId
     *
     * @param integer $imgId
     * @return PostImg
     */
    public function setImgId($imgId)
    {
        $this->imgId = $imgId;

        return $this;
    }

    /**
     * Get imgId
     *
     * @return integer
     */
    public function getImgId()
    {
        return $this->imgId;
    }
}

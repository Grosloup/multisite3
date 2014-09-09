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
     * @ORM\Column(name="post_long_id", length=255, nullable=false, type="string")
     */
    private $postLongId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="ZPB\AdminBundle\Entity\MediaImage")
     */
    private $img;


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
     * Set img
     *
     * @param MediaImage $img
     * @return PostImg
     */
    public function setImg(MediaImage $img = null)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return MediaImage
     */
    public function getImg()
    {
        return $this->img;
    }
}

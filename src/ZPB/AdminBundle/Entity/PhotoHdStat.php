<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PhotoHdStat
 *
 * @ORM\Table(name="zpb_photo_hd_stats")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PhotoHdStatRepository")
 */
class PhotoHdStat
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
     * @ORM\Column(name="photo_id", type="integer")
     */
    private $photoId;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255)
     */
    private $host;

    /**
     * @ORM\Column(name="reporter_id", type="integer", nullable=true)
     */
    private $reporter;


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
     * @return mixed
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @param mixed $reporter
     * @return PhotoHdStat
     */
    public function setReporter($reporter)
    {
        $this->reporter = $reporter;
        return $this;
    }



    /**
     * Set photoId
     *
     * @param integer $photoId
     * @return PhotoHdStat
     */
    public function setPhotoId($photoId)
    {
        $this->photoId = $photoId;

        return $this;
    }

    /**
     * Get photoId
     *
     * @return integer 
     */
    public function getPhotoId()
    {
        return $this->photoId;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return PhotoHdStat
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PhotoHdStat
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set host
     *
     * @param string $host
     * @return PhotoHdStat
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string 
     */
    public function getHost()
    {
        return $this->host;
    }
}

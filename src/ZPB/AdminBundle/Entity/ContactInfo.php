<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContactInfo
 *
 * @ORM\Table(name="zpb_contact_info")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\ContactInfoRepository")
 */
class ContactInfo
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
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\Email(checkHost=true, checkMX=true, message="Ce n'est pas une adresse email valide.")
     * @Assert\NotBlank(message="Ce champs est requis")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="topic", type="string", length=255, nullable=true)
     */
    private $topic;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     * @Assert\NotBlank(message="Ce champs est requis")
     * @Assert\Regex("/^[a-zàéèêëûüîïôöçù0-9,;:!$%?.&#+=\/\\*' _-]$/i", message="Ce champs contient des caractères non autorisés")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_send", type="boolean")
     */
    private $isSend;

    /**
     * @ORM\Column(name="source", type="string", length=255, nullable=false )
     */
    private $source;

    public function __construct()
    {
        $this->isSend = false;
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
     * Set email
     *
     * @param string $email
     * @return ContactInfo
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set topic
     *
     * @param string $topic
     * @return ContactInfo
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return ContactInfo
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactInfo
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
     * Set isSend
     *
     * @param boolean $isSend
     * @return ContactInfo
     */
    public function setIsSend($isSend)
    {
        $this->isSend = $isSend;

        return $this;
    }

    /**
     * Get isSend
     *
     * @return boolean 
     */
    public function getIsSend()
    {
        return $this->isSend;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     * @return ContactInfo
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }


}

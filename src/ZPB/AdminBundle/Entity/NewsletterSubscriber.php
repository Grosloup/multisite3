<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * NewsletterSubscriber
 *
 * @ORM\Table(name="zpb_newsletter_subscriber")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\NewsletterSubscriberRepository")
 */
class NewsletterSubscriber
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
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Ce champ est requis")
     * @Assert\Regex(pattern="/[a-zA-Zéèêëàâûüîïç' -]+/", message="Ce champs contient des caractères non autorisés.")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Ce champ est requis")
     * @Assert\Regex(pattern="/[a-zA-Zéèêëàâûüîïç' -]+/", message="Ce champs contient des caractères non autorisés.")
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="born_at", type="datetime", nullable=true)
     */
    private $bornAt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Ce champ est requis")
     * @Assert\Email(message="Cet email n'est pas valide.", checkMX=true, checkHost=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\PostTarget")
     * @ORM\JoinColumn(name="target_id")
     */
    private $target;


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
     * Set firstname
     *
     * @param string $firstname
     * @return NewsletterSubscriber
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return NewsletterSubscriber
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set bornAt
     *
     * @param \DateTime $bornAt
     * @return NewsletterSubscriber
     */
    public function setBornAt($bornAt)
    {
        $this->bornAt = $bornAt;

        return $this;
    }

    /**
     * Get bornAt
     *
     * @return \DateTime
     */
    public function getBornAt()
    {
        return $this->bornAt;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return NewsletterSubscriber
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return NewsletterSubscriber
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
     * Set target
     *
     * @param PostTarget $target
     * @return NewsletterSubscriber
     */
    public function setTarget(PostTarget $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return PostTarget
     */
    public function getTarget()
    {
        return $this->target;
    }
}

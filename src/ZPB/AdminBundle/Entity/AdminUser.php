<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use ZPB\AdminBundle\Validator\Constraints as ZPBAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AdminUser
 *
 * @ORM\Table(name="zpb_admin_users")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AdminUserRepository")
 * @UniqueEntity("username", message="Ce nom d'utilisateur est déjà utilisé.")
 * @UniqueEntity("email", message="Cet email est déjà utilisé.")
 */
class AdminUser implements AdvancedUserInterface, Serializable
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
     * @Assert\NotBlank(message="Ce champs est requis")
     * @Assert\Regex("/^[a-zàéèêëûüîïôöçù' -]$/i", message="Ce champs contient des caractères non autorisés")
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis")
     * @Assert\Regex("/^[a-zàéèêëûüîïôöçù' -]$/i", message="Ce champs contient des caractères non autorisés")
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis")
     * @Assert\Regex("/^[a-zàéèêëûüîïôöçù0-9,;:!$%?.&#+=\/\\*' -]$/i", message="Ce champs contient des caractères non autorisés")
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis")
     * @Assert\Email(checkHost=true, checkMX=true, message="Ce n'est pas une adresse email valide.")
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     * @ZPBAssert\Civility()
     * @ORM\Column(name="civility", type="string", length=255)
     */
    private $civility;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var boolean
     * @ORM\Column(name="is_locked", type="boolean", nullable=false)
     */
    private $isLocked;

    /**
     * @var string
     * @ZPBAssert\Password()
     */
    private $plainPassword;

    /**
     * @var string
     * @ORM\Column(name="activation_code", type="string", length=255, nullable=true)
     */
    private $activationCode;

    /**
     * @var \dateTime
     * @ORM\Column(name="activated_at", type="datetime", nullable=true)
     */
    private $activatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="register_before", type="datetime", nullable=true)
     */
    private $registerBefore;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->isActive = false;
        $this->isLocked = false;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->activationCode = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return AdminUser
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
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
     * @return \dateTime
     */
    public function getActivatedAt()
    {
        return $this->activatedAt;
    }

    /**
     * @param \dateTime $activatedAt
     * @return AdminUser
     */
    public function setActivatedAt($activatedAt)
    {
        $this->activatedAt = $activatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivationCode()
    {
        return $this->activationCode;
    }

    /**
     * @param string $activationCode
     * @return AdminUser
     */
    public function setActivationCode($activationCode)
    {
        $this->activationCode = $activationCode;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     * @return AdminUser
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * @param boolean $isLocked
     * @return AdminUser
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return AdminUser
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegisterBefore()
    {
        return $this->registerBefore;
    }

    /**
     * @param \DateTime $registerBefore
     * @return AdminUser
     */
    public function setRegisterBefore($registerBefore)
    {
        $this->registerBefore = $registerBefore;
        return $this;
    }



    /**
     * Set firstname
     *
     * @param string $firstname
     * @return AdminUser
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
     * @return AdminUser
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
     * Set username
     *
     * @param string $username
     * @return AdminUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return AdminUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return AdminUser
     */
    public function setRoles($roles)
    {
        $this->roles = array_unique(array_merge($this->roles, $roles));

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return AdminUser
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return AdminUser
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
     * Set civility
     *
     * @param string $civility
     * @return AdminUser
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return string
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return AdminUser
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }


    public function isAccountNonExpired()
    {
        return true;
    }


    public function isAccountNonLocked()
    {
        return !$this->isLocked;
    }


    public function isCredentialsNonExpired()
    {
        return true;
    }


    public function isEnabled()
    {
        return $this->isActive;
    }


    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function serialize()
    {

        return serialize([
                $this->id,
                $this->username,
                $this->password
            ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }
}

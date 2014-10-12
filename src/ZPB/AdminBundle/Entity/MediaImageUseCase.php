<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaImageUseCase
 *
 * @ORM\Table(name="zpb_images_use_cases")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\MediaImageUseCaseRepository")
 */
class MediaImageUseCase
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
     * @ORM\Column(name="use_case", type="string", length=255)
     */
    private $useCase;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\MediaImage", inversedBy="use_cases")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;


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
     * Set useCase
     *
     * @param string $useCase
     * @return MediaImageUseCase
     */
    public function setUseCase($useCase)
    {
        $this->useCase = $useCase;

        return $this;
    }

    /**
     * Get useCase
     *
     * @return string
     */
    public function getUseCase()
    {
        return $this->useCase;
    }

    /**
     * Set image
     *
     * @param MediaImage $image
     * @return MediaImageUseCase
     */
    public function setImage(MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }
}

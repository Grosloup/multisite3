<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqTarget
 *
 * @ORM\Table(name="zpb_faqs_targets")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\FaqTargetRepository")
 */
class FaqTarget
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
     * @ORM\Column(name="faq_id", type="integer")
     */
    private $faqId;

    /**
     * @var integer
     *
     * @ORM\Column(name="target_id", type="integer")
     */
    private $targetId;


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
     * Get faqId
     *
     * @return integer
     */
    public function getFaqId()
    {
        return $this->faqId;
    }

    /**
     * Set faqId
     *
     * @param integer $faqId
     * @return FaqTarget
     */
    public function setFaqId($faqId)
    {
        $this->faqId = $faqId;

        return $this;
    }

    /**
     * Get targetId
     *
     * @return integer
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    /**
     * Set targetId
     *
     * @param integer $targetId
     * @return FaqTarget
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;

        return $this;
    }
}

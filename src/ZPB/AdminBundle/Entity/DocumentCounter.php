<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * DocumentCounter
 *
 * @ORM\Table(name="zpb_documents_counters")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\DocumentCounterRepository")
 */
class DocumentCounter
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     * @ORM\Column(name="document_id", type="string", nullable=false, length=15)
     */
    private $documentId;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return DocumentCounter
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
     * @return string
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @param string $documentId
     * @return DocumentCounter
     */
    public function setDocumentId($documentId)
    {
        $this->documentId = $documentId;
        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class BaseEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     * @SWG\Property(readOnly=true)
     */
    protected $id;

    /**
     * @ORM\Column(name="created_at", nullable=false, type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @SWG\Property(readOnly=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", nullable=false, type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @SWG\Property(readOnly=true)
     */
    private $updatedAt;

    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getObjectName()
    {
        return (string) $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     *
     * @return BaseEntity
     */
    public function setCreatedAt()
    {
        try {
            $this->createdAt = new \DateTime();
        } catch (\Exception $e) {
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return BaseEntity
     */
    public function setUpdatedAt()
    {
        try {
            $this->updatedAt = new \DateTime();
        } catch (\Exception $e) {
        }

        return $this;
    }
}

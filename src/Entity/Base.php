<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class Base
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    #[ORM\Column(type: 'integer')]
    private string $id;

    #[ORM\Column(type: 'boolean')]
    private bool $enabled = true;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTimeInterface $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }
   

    /**
     * Set enabled
     *
     * @param boolean $enabled enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInteface $createdAt
     *
     * @return $this
     * @throws \Exception
     */
    public function setCreatedAt(\DateTimeInterface $createdAt=null): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTimeInteface
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTimeInterface $updatedAt
     *
     * @return $this
     * @throws \Exception
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedAt(){
        $this->setUpdatedAt(new DateTime());
    }

    #[ORM\PrePersist]
    public function createdAt(){
        $this->setCreatedAt(new DateTime());
    }

}

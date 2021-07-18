<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass:TransactionRepository::class)]
class Transaction
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private $id;


    #[ORM\ManyToOne(targetEntity:Account::class, inversedBy:"fromTransactions")]
    private $fromAccount;


    #[ORM\ManyToOne(targetEntity:Account::class, inversedBy:"toTransactions")]
    private $toAccount;

    #[ORM\Column(type:"string", length:255)]
    private $name;

    #[ORM\Column(type:"decimal", precision:13, scale:4)]
    private $amount;

    #[ORM\Column(type:"text", nullable:true)]
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromAccount(): ?Account
    {
        return $this->fromAccount;
    }

    public function setFromAccount(?Account $fromAccount): self
    {
        $this->fromAccount = $fromAccount;

        return $this;
    }

    public function getToAccount(): ?Account
    {
        return $this->toAccount;
    }

    public function setToAccount(?Account $toAccount): self
    {
        $this->toAccount = $toAccount;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}

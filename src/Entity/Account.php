<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["physical" => "PhysicalAccount", "virtual" => "VirtualAccount"])]
#[ORM\UniqueConstraint(name:"name_unique", columns: ["name"] )]
abstract class Account extends Base
{

    #[ORM\Column(type:'decimal', precision: 13, scale: 4)]
    private $balance;


    #[ORM\Column(type:'string', length: 255)]
    private $name;



    public function __construct(
        string $name
     )
    {
        $this->name = $name;
        $this->balance = "0";
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function addBalance(string $amount): self
    {
        $this->balance = bcadd($this->balance, $amount);
        return $this;
    }

    public function subBalance(string $amount): self
    {
        $this->balance = bcsub($this->balance, $amount);
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

}

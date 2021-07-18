<?php

namespace App\Entity;

use App\Repository\PhysicalAccountRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: PhysicalAccountRepository::class)]
class PhysicalAccount extends Account
{
    public const FLOW_ASSET = 1;
    public const FLOW_EXPENSE = 2;
    public const FLOW_REVENUE = 3;


    #[ORM\OneToMany(targetEntity: VirtualAccount::class, mappedBy: 'parentAccount')]
    private Collection $virtualAccounts;

    #[ORM\Column(type:'decimal', precision: 13, scale: 4)]
    private string $virtualBalance = "0";


    #[ORM\Column(type:'integer')]
    private int $flow = 1;


    public function __construct(
        string $name,
        string $flow = self::FLOW_ASSET
    )
    {
        $this->flow = $flow;
        parent::__construct($name);
    }

    public function addVirtualBalance(string $amount): self
    {
        $this->virtualBalance = bcadd($this->virtualBalance, $amount);
        return $this;
    }

    public function subVirtualBalance(string $amount): self
    {
        $this->virtualBalance = bcsub($this->virtualBalance, $amount);
        return $this;
    }

    public function getVirtualAccounts(){
        return $this->virtualAccounts;
    }

    public function getFlow(){
        return $this->flow;
    }

    public function setFlow($flow){
        $this->flow = $flow;
        return $this;
    }

}

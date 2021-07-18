<?php

namespace App\Entity;

use App\Repository\VirtualAccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VirtualAccountRepository::class)]
class VirtualAccount extends Account
{

    #[ORM\ManyToOne(targetEntity: PhysicalAccount::class, inversedBy: "virtualAccounts")]
    private PhysicalAccount $parentAccount;


    public function __construct(
        string $name,
        PhysicalAccount $parentAccount
    )
    {
        parent::__construct($name);
        $this->parentAccount = $parentAccount;
    }

    public function getParentAccount(){
        return $this->parentAccount;
    }

    public function setParentAccount(PhysicalAccount $parentAccount){
        $this->parentAccount = $parentAccount;
        return $this;
    }
}

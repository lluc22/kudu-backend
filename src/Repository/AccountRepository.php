<?php

namespace App\Repository;

use App\Entity\Account;
use App\Entity\PhysicalAccount;
use App\Entity\VirtualAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class AccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function findByName(string $name){
        return $this->findOneBy([
            'name' => $name
        ]);
    }

}

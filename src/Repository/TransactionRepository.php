<?php

namespace App\Repository;

use App\Entity\Account;
use App\Entity\PhysicalAccount;
use App\Entity\Transaction;
use App\Entity\VirtualAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function createNewTransaction(
        ?Account $from, 
        ?Account $to, 
        string $name, 
        string $amount, 
        ?string $notes = null
    ){
        $em = $this->getEntityManager();
        $transaction = new Transaction();
        $transaction
            ->setName($name)
            ->setFromAccount($from)
            ->setToAccount($to)
            ->setAmount($amount)
            ->setNotes($notes);

        $from?->subBalance($amount);
        $to?->addBalance($amount);
        if($from instanceof VirtualAccount){
            $from->getParentAccount()?->subBalance($amount);
        }
        if($to instanceof VirtualAccount){
            $to->getParentAccount()?->addBalance($amount);
        }
        if($from instanceof PhysicalAccount){
            $from->subVirtualBalance($amount);
        }
        if($to instanceof PhysicalAccount){
            $to->addVirtualBalance($amount);
        }
        if($from) $em->persist($from);
        if($to) $em->persist($to);
        $em->persist($transaction);
        return $transaction;
    }

}

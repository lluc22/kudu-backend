<?php

namespace App\Repository;

use App\Entity\PhysicalAccount;
use App\Entity\VirtualAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MoneyUtils;

/**
 * @method VirtualAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method VirtualAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method VirtualAccount[]    findAll()
 * @method VirtualAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VirtualAccountRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private TransactionRepository $transactionRepo
    )
    {
        parent::__construct($registry, VirtualAccount::class);
    }

    public function createAccount(
        string $name,
        PhysicalAccount $parentAccount,
        string $initialBalance = "0"
    ){
        $em = $this->getEntityManager();
        $account = new VirtualAccount($name, $parentAccount);
        if(! MoneyUtils::isZero($initialBalance)){
            $this->transactionRepo->createNewTransaction(
                $parentAccount, 
                $account, 
                "Balanç inicial",
                $initialBalance
            );
        }
        $em->persist($account);
        return $account;
    }

    // /**
    //  * @return VirtualAccount[] Returns an array of VirtualAccount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VirtualAccount
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

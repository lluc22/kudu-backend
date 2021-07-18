<?php

namespace App\Repository;

use App\Entity\PhysicalAccount;
use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MoneyUtils;

/**
 * @method PhysicalAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicalAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicalAccount[]    findAll()
 * @method PhysicalAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicalAccountRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private TransactionRepository $transactionRepo
    )
    {
        parent::__construct($registry, PhysicalAccount::class);
    }

    public function createAccount(
        string $name,
        int $flow,
        string $initialBalance = "0"
    ){
        $em = $this->getEntityManager();
        $account = new PhysicalAccount($name, $flow);
        if(! MoneyUtils::isZero($initialBalance)){
            $this->transactionRepo->createNewTransaction(
                null, 
                $account, 
                "Balanç inicial",
                $initialBalance
            );
        }
        $em->persist($account);
        return $account;
    }

    // /**
    //  * @return PhysicalAccount[] Returns an array of PhysicalAccount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PhysicalAccount
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

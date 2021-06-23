<?php

namespace App\Repository;

use App\Entity\ServicesAvailable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServicesAvailable|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicesAvailable|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicesAvailable[]    findAll()
 * @method ServicesAvailable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesAvailableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicesAvailable::class);
    }

    // /**
    //  * @return ServicesAvailable[] Returns an array of ServicesAvailable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServicesAvailable
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

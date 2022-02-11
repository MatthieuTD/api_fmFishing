<?php

namespace App\Repository;

use App\Entity\Fishes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fishes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fishes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fishes[]    findAll()
 * @method Fishes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FishesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fishes::class);
    }

    // /**
    //  * @return Fishes[] Returns an array of Fishes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fishes
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

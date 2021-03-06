<?php

namespace App\Repository;

use App\Entity\Spots;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Spots|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spots|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spots[]    findAll()
 * @method Spots[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpotsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spots::class);
    }

    public function findByName(String $nameSearch){
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT * FROM spots
            WHERE name LIKE '%".$nameSearch."%'
            ";
            $stmt = $conn->prepare($sql);
         $result =   $stmt->executeQuery();

        return $result->fetchAllAssociative();
    }
    // /**
    //  * @return Spots[] Returns an array of Spots objects
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
    public function findOneBySomeField($value): ?Spots
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

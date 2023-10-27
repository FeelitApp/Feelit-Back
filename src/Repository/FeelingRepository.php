<?php

namespace App\Repository;

use App\Entity\Feeling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Feeling>
 *
 * @method Feeling|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feeling|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feeling[]    findAll()
 * @method Feeling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeelingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feeling::class);
    }

//    /**
//     * @return Feeling[] Returns an array of Feeling objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Feeling
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

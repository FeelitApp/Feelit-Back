<?php

namespace App\Repository;

use App\Entity\Sensation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sensation>
 *
 * @method Sensation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sensation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sensation[]    findAll()
 * @method Sensation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SensationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sensation::class);
    }

//    /**
//     * @return Sensation[] Returns an array of Sensation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sensation
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

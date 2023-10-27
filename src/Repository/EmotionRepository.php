<?php

namespace App\Repository;

use App\Entity\Emotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emotion>
 *
 * @method Emotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emotion[]    findAll()
 * @method Emotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emotion::class);
    }

//    /**
//     * @return Emotion[] Returns an array of Emotion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Emotion
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

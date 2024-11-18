<?php

namespace App\Repository;

use App\Entity\Goal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Goal>
 */
class GoalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Goal::class);
    }

       /**
        * @return Goal[] Returns an array of Goal objects
        */
       public function findByVeterinary($value): array
       {
           return $this->createQueryBuilder('g')
               ->leftJoin('g.veterinary', 'v')
               ->leftJoin('g.product', 'p')
               ->select('v.name')
               ->addSelect('g.id')
               ->addSelect('g.amount')
               ->addSelect('p.name')
               ->andWhere('g.veterinary = :val')
               ->setParameter('val', $value.get)
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Goal
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

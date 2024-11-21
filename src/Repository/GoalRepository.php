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
       public function findByVeterinary($veterinary): array
       {
           return $this->createQueryBuilder('g')
               ->andWhere('g.veterinary = :veterinary')
               ->setParameter('veterinary', $veterinary->getid())
               ->getQuery()
               ->getResult()
           ;
       }

       /** 
        * 
        **/

       public function findByYear($value): ?Goal
       {
           return $this->createQueryBuilder('g')
               ->andWhere('g.exampleField = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }
}

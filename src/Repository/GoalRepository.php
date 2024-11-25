<?php

namespace App\Repository;

use App\Entity\Goal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Veterinary;

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
        public function findByVeterinaryAndOrYear(?Veterinary $veterinary, ?int $year): array
        {
            if(!is_null($veterinary) && !is_null($year)){
                $val = $this->createQueryBuilder('g')
                    ->innerJoin('g.veterinary', 'v')
                    ->where('v.id = :idVeterinary')
                    ->andWhere('g.year = :year')
                    ->setParameter('idVeterinary', $veterinary->getId())
                    ->setParameter('year', $year)
                    ->getQuery()
                    ->getResult()
                    ;
                return $val;
            }
            if(!is_null($veterinary) && is_null($year)){
                $val = $this->createQueryBuilder('g')
                ->innerJoin('g.veterinary', 'v')
                ->where('v.id = :idVeterinary')
                ->setParameter('idVeterinary', $veterinary->getId())
                ->getQuery()
                ->getResult();
                return $val;
            }
            
            $val = $this->createQueryBuilder('g')
                ->innerJoin('g.veterinary', 'v')
                ->where('g.year = :year')
                ->setParameter('year', $year)
                ->getQuery()->getResult();
            return $val;
        }

       /** 
        * 
        **/

       
}

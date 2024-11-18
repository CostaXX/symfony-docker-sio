<?php

namespace App\Repository;

use App\Entity\FollowUp;
use App\Entity\Veterinary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FollowUp>
 */
class FollowUpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FollowUp::class);
    }

       /**
        * @return FollowUp[] Returns an array of FollowUp objects
        */
       public function GetAllFollowupsOrderByCallDate(): array
       {
           return $this->createQueryBuilder('f')
                ->leftjoin('f.veterinary','v')
                ->select('f.id')
                ->addSelect('v.name')
                ->addSelect('f.contactName')
                ->addSelect('f.callDate')
                ->addSelect('f.comment')
                ->orderBy('f.callDate', 'DESC')
                ->getQuery()
                ->getResult()
           ;
       }

       public function GetFollowUpByVeterinaryId($veterinaryId): array
       {
           return $this->createQueryBuilder('f')
               ->leftJoin('f.veterinary','v')
               ->select('f.id')
               ->addSelect('v.name')
               ->addSelect('f.contactName')
               ->addSelect('f.comment')
               ->addSelect('f.callDate')
               ->andWhere('f.veterinary = :val')
               ->setParameter('val', $veterinaryId)
               ->getQuery()
               ->getResult()
           ;
       }
}

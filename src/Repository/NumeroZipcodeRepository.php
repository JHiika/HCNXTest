<?php

namespace App\Repository;

use App\Entity\NumeroZipcode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NumeroZipcodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumeroZipcode::class);
    }

    public function findAllOrderedByZipcode()
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.zipcode', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findMostUsedZipcode(int $limit=10):array
    {
        $results = $this->createQueryBuilder('n')
                    ->select('count(n.numero) AS Compteur,n.zipcode')
                    ->groupBy("n.zipcode")
                    ->orderBy('Compteur','DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();

        return $results;
    }

    public function findOthersZipcode():array
    {
        $results = $this->createQueryBuilder('n')
                        ->select('COUNT(n.zipcode) AS Compteur')
                        ->getQuery()
                        ->getResult();
        return $results;
    }
}

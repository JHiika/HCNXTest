<?php

namespace App\Repository;

use App\Entity\NumeroDons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NumeroDonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumeroDons::class);
    }

    public function findToTenDonator():array
    {
        return $this->createQueryBuilder('n')
            ->select('n.numero,n.montant')
            ->orderBy('n.montant', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findAllAmount():array
    {
        return $this->createQueryBuilder('n')
            ->select('count(n.montant) AS Compteur, n.montant')
            ->groupBy('n.montant')
            ->orderBy('Compteur', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

}

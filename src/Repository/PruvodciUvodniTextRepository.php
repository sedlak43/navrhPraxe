<?php

namespace App\Repository;

use App\Entity\PruvodciUvodniText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PruvodciUvodniTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PruvodciUvodniText::class);
    }
}

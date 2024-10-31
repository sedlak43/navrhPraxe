<?php

namespace App\Repository;

use App\Entity\ClenoveTymu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClenoveTymuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClenoveTymu::class);
    }

    public function findAllClenoveTymu()
    {
        return $this->findAll();
    }
}


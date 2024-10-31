<?php

namespace App\Repository;

use App\Entity\Zajezdy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ZajezdyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zajezdy::class); // Explicitly pass Zajezdy class
    }

    public function findDistinctDestinaces(): array
    {
        $results = $this->createQueryBuilder('z')
            ->select('DISTINCT z.destinace')
            ->getQuery()
            ->getScalarResult();

        // Flatten the result array
        return array_column($results, 'destinace');
    }

    public function findDistinctDopravas(): array
    {
        $results = $this->createQueryBuilder('z')
            ->select('DISTINCT z.doprava')
            ->getQuery()
            ->getScalarResult();

        // Flatten the result array
        return array_column($results, 'doprava');
    }

    public function findDistinctTypes(): array
    {
        $results = $this->createQueryBuilder('z')
            ->select('DISTINCT z.typ')
            ->getQuery()
            ->getScalarResult();

        // Flatten the result array
        return array_column($results, 'typ');
    }

    public function findAllSortedByDate()
    {
        return $this->createQueryBuilder('z')
            ->leftJoin('z.datumy', 'd')
            ->orderBy('d.datum', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByCriteriaAndDate(?string $date, array $criteria, ?string $cena = null): array
    {
        $qb = $this->createQueryBuilder('z')
            ->leftJoin('z.datumy', 'd')
            ->addSelect('d');

        // Add filters based on criteria
        foreach ($criteria as $field => $value) {
            $qb->andWhere("z.$field = :$field")
                ->setParameter($field, $value);
        }

        // Filter by month and year if date is provided
        if ($date) {
            $year = (new \DateTime($date))->format('Y');
            $month = (new \DateTime($date))->format('m');
            $qb->andWhere('SUBSTRING(d.datum, 1, 4) = :year')
                ->andWhere('SUBSTRING(d.datum, 6, 2) = :month')
                ->setParameter('year', $year)
                ->setParameter('month', $month);
        }

        // Apply price sorting if 'cena' is selected
        if ($cena) {
            $qb->orderBy('z.cena', strtoupper($cena) === 'DESC' ? 'DESC' : 'ASC');
        } else {
            $qb->orderBy('d.datum', 'ASC'); // Default sorting by date if no 'cena' selected
        }

        return $qb->getQuery()->getResult();
    }

}


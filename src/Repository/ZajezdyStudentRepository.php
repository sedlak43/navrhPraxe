<?php

namespace App\Repository;

use App\Entity\Aktuality;
use App\Entity\ZajezdyStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ZajezdyStudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZajezdyStudent::class);
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

    public function findByCriteriaAndDate(array $criteria, ?string $date): array
    {
        $qb = $this->createQueryBuilder('z')
            ->leftJoin('z.datumy_student', 'd') // Join the dates table
            ->addSelect('d');

        // Add criteria for destination, transportation, and type
        foreach ($criteria as $field => $value) {
            $qb->andWhere("z.$field = :$field")
                ->setParameter($field, $value);
        }

        // If a date is provided, search by month and year only
        if ($date) {
            $year = (new \DateTime($date))->format('Y');
            $month = (new \DateTime($date))->format('m');

            // Use SUBSTRING to extract the year and month from the date
            $qb->andWhere('SUBSTRING(d.datum, 1, 4) = :year')
                ->andWhere('SUBSTRING(d.datum, 6, 2) = :month')
                ->setParameter('year', $year)
                ->setParameter('month', $month);
        }

        // Add ordering by the 'zajezd_order' field
        $qb->orderBy('z.zajezd_order', 'ASC'); // Adjust 'ASC' to 'DESC' if you want descending order

        return $qb->getQuery()->getResult();
    }
}

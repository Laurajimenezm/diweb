<?php

namespace App\Repository;

use App\Entity\Gatoperro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gatoperro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gatoperro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gatoperro[]    findAll()
 * @method Gatoperro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GatoperroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gatoperro::class);
    }

    // /**
    //  * @return Gatoperro[] Returns an array of Gatoperro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gatoperro
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

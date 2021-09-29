<?php

namespace App\Repository;

use App\Entity\Carousel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Carousel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carousel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carousel[]    findAll()
 * @method Carousel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarouselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carousel::class);
    }

    // /**
    //  * @return Carousel[] Returns an array of Carousel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Carousel
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Entrainement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entrainement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrainement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrainement[]    findAll()
 * @method Entrainement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrainementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrainement::class);
    }

    // /**
    //  * @return Entrainement[] Returns an array of Entrainement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entrainement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // src/Repository/UserRepository.php, SiteRepository.php, TopoRepository.php, etc.
    public function count(array $criteria = []): int
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->where('1=1')
            ->andWhere(array_map(function ($field, $value) {
                return "e.$field = :$field";
            }, array_keys($criteria), $criteria))
            ->setParameters($criteria)
            ->getQuery()
            ->getSingleScalarResult();
    }
}

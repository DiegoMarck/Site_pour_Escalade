<?php

namespace App\Repository;

use App\Entity\Site;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Site|null find($id, $lockMode = null, $lockVersion = null)
 * @method Site|null findOneBy(array $criteria, array $orderBy = null)
 * @method Site[]    findAll()
 * @method Site[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Site::class);
    }

    // /**
    //   * @return Site[] Returns an array of Site objects
    //   */
    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('s')
    //         ->andWhere('s.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('s.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }


    /*
    public function findOneBySomeField($value): ?Site
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return int/mixed/string
     */
    public function countAllSite()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id) as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

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

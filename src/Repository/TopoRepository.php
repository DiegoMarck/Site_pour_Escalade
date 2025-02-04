<?php

namespace App\Repository;

use App\Entity\Topo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Topo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topo[]    findAll()
 * @method Topo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topo::class);
    }

    // /**
    //  * @return Topo[] Returns an array of Topo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Topo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return int/mixed/string
     */
    public function countAllTopo()
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

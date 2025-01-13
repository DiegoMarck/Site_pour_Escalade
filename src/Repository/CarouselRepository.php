<?php

namespace App\Repository;

use App\Entity\Carousel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Carousel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carousel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carousel[]    findAll()
 * @method Carousel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarouselRepository extends ServiceEntityRepository
{
    // public function __construct(ManagerRegistry $registry)
    // {
    //     parent::__construct($registry, Carousel::class);
    // }

    // /**
    //  * @return Carousel[] Returns an array of Carousel objects
    //  */

    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('c.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }



    // public function findOneBySomeField($value): ?Carousel
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }

    // public function findCarouselWithMedia($value)
    // {
    //     return $this->createQueryBuilder('c')
    //         ->select('c', 'm') // On sélectionne `c` pour Carousel et `m` pour Media
    //         ->join('App\Entity\Media', 'm', 'WITH', 'c.id = m.carousel') // Jointure avec Media en utilisant `m` comme alias
    //         ->where('c.exampleField = :val') // Utilisation de l'alias `c` pour éviter l'ambiguïté
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getResult();
    // }
    // private $entityManager;

    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->entityManager = $entityManager;
    // }

    // public function getCarouselByTableName(string $tableName): array
    // {
    //     $query = $this->entityManager->createQuery(
    //         'SELECT c FROM App\Entity\Carousel c WHERE c.tableName = :value'
    //     );
    //     $query->setParameter('value', $tableName);

    //     return $query->getResult();
    // }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carousel::class);
    }

    /**
     * @return Carousel[] Returns an array of Carousel objects
     */
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findOneBySomeField($value): ?Carousel
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findCarouselWithMedia($value)
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'm')
            ->leftJoin('c.media', 'm')
            ->where('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function getCarouselByExampleField(string $exampleField): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.exampleField = :value')
            ->setParameter('value', $exampleField)
            ->getQuery()
            ->getResult();
    }
}

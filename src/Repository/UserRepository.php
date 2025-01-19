<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }
    /**
     * @return int/mixed/string
     */
    // public function countAllUser()
    // {
    //     $queryBuilder = $this->createQueryBuilder('a');
    //     $queryBuilder->select('COUNT(a.id) as value');

    //     return $queryBuilder->getQuery()->getOneOrNullResult();
    // }

    // src/Repository/UserRepository.php
    // src/Repository/UserRepository.php
    public function countAllUser()
    {
        try {
            return $this->createQueryBuilder('u')
                ->select('COUNT(u.id)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
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
    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\UsersPurchases;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersPurchases|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersPurchases|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersPurchases[]    findAll()
 * @method UsersPurchases[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersPurchasesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersPurchases::class);
    }

//    /**
//     * @return UsersPurchases[] Returns an array of UsersPurchases objects
//     */
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
    public function findOneBySomeField($value): ?UsersPurchases
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

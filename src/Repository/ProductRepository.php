<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function findByFilter($filter)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where(' (p.name LIKE \'%'.$filter->getSearch().'%\' ')
            ->orWhere('p.comment LIKE \'%'.$filter->getSearch().'%\')')
         //   ->setParameter(':search', $filter->getSearch())
            ->andWhere('p.price <= :to')
            ->setParameter(':to', $filter->getPriceTo())
            ->andWhere('p.price >= :from')
            ->setParameter(':from', $filter->getPriceFrom())
            ->orderBy('p.name', $filter->getNameAscDesc())
         //   ->addOrderBy('p.name', $filter->getNameAsc())
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

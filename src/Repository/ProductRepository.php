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


    public function findByFilter(object $filter): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where(' (p.name LIKE :comment ')
            ->orWhere('p.comment LIKE :comment)')
            ->setParameter('comment', '%'.$filter->getSearch().'%')
            ->andWhere('p.price <= :to')
            ->setParameter('to', $filter->getPriceTo())
            ->andWhere('p.price >= :from')
            ->setParameter('from', $filter->getPriceFrom())
            ->orderBy('p.name', $filter->getNameAscDesc())
            ->getQuery()
            ->getResult()
        ;
    }

    public function previewFindById(int $id): array
    {
        return $this->createQueryBuilder('p')
            ->select('p, u')
            ->join(
                'App\Entity\ProductImage',
                'u',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'p.id = u.productId'
            )
            ->where('p.id ='.$id)
            ->getQuery()
            ->getResult()
            ;
    }

}

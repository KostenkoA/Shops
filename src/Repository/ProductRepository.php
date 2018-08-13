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
    /**
     * ProductRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Generate array of objects products according to the given parameters
     *
     * @param object $filter
     * @return array
     */
    public function findByFilter(object $filter): array
    {
        $select = $this->createQueryBuilder('p')
            ->select('p');
            if (!empty($filter->getSearch())) {
                $select->where(' (p.name LIKE :comment ')
                    ->orWhere('p.comment LIKE :comment)')
                    ->setParameter('comment', '%' . $filter->getSearch() . '%');
            }
            if (!empty($filter->getPriceFrom())) {
                $select->andWhere('p.price >= :from')
                    ->setParameter('from', $filter->getPriceFrom());
            }
            if (!empty($filter->getPriceTo())) {
                $select->andWhere('p.price <= :to')
                    ->setParameter('to', $filter->getPriceTo());
            }
            if (!empty($filter->getTypeId()->getKeys())){
                $typeId = '';
                    foreach ($filter->getTypeId() as $type) {
                        $typeId .= $type->getId() . ',';
                    }
                    $typeId = \rtrim($typeId, ',');
                    $select->andWhere('p.typeId IN ('.$typeId.')');
            }

           return $select->orderBy('p.name', $filter->getNameAscDesc())
                ->getQuery()
                ->getResult();
    }

    /**
     * Generate array of objects products and products images from ProductImages entity according to given id
     *
     * @param int $id
     * @return array
     */
    public function previewFindById(int $id): array
    {
        return $this->createQueryBuilder('p')
            ->select('p, u')
            ->leftJoin(
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

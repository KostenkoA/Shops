<?php

namespace App\Repository;

use App\Entity\MainCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MainCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainCategory[]    findAll()
 * @method MainCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MainCategory::class);
    }
}

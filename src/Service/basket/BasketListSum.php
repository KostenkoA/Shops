<?php

namespace App\Service\basket;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;


class BasketListSum
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getSumPurchases(array $userPurchases): int
    {
        $sum = 0;

        foreach ($userPurchases as $userPurchase) {
            $product = $this->em
                ->getRepository(Product::class)
                ->find($userPurchase->getProductId());

            $sum += $product->getPrice();
        }

        return $sum;
    }
}
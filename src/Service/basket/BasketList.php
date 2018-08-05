<?php

namespace App\Service\basket;


use App\Entity\Product;
use App\Entity\ProductImage;
use Doctrine\ORM\EntityManagerInterface;


class BasketList implements UsersChoiceList
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $userPurchases
     * @return array
     */
    public function usersChoiceList(array $userPurchases): array
    {
        $basketList = [];

        foreach ($userPurchases as $userPurchase) {

            $products = $this->em
                ->getRepository(Product::class)
                ->find($userPurchase->getProductId());

            $basketList[] = $products;
        }

        return $basketList;
    }
}
<?php

namespace App\Service\basket;


use App\Entity\Product;
use App\Entity\ProductImage;
use Doctrine\ORM\EntityManagerInterface;


class BasketList implements UsersChoiceList
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * BasketList constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * usersChoiceList method addes each choice users product in array
     *
     * @param array $userPurchases
     * @return array
     */
    public function usersChoiceList(array $userPurchases): array
    {
        $basketList = [];

        foreach ($userPurchases as $userPurchase) {

            $products = $this->em
                ->getRepository(Product::class)
                ->previewFindById($userPurchase->getProductId());

            $basketList[] = $products;
        }

        return $basketList;
    }
}
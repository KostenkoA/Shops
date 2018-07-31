<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductListController extends AbstractController
{
    public function getProductList()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $productImages = $this->getDoctrine()
            ->getRepository(ProductImage::class)
            ->findAll();

        return $this->render('homepage/main.html.twig', [
            'products' => $products,
            'productImages' => $productImages
        ]);
    }

}
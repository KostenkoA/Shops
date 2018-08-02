<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductListController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getProductList()
    {
        //TODO move implementation to the repository

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findByFilter();

        $productImages = $this->getDoctrine()
            ->getRepository(ProductImage::class)
            ->findAll();

        return $this->render('homepage/main.html.twig', [
            'products' => $products,
            'productImages' => $productImages
        ]);
    }

}
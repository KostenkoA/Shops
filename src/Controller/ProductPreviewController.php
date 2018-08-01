<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductPreviewController extends AbstractController
{
    public function getProductPreview(int $id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id)
            ;

        $productImages = $this->getDoctrine()
            ->getRepository(ProductImage::class)
            ->findBy(['productId' => $id])
            ;

        return $this->render('preview/productPreview.html.twig', [
           'product' => $product,
           'productImages' => $productImages
        ]);
    }
}
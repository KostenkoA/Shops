<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Entity\Product;
use App\Entity\ProductImage;
use App\Form\FilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductListController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getProductList(Request $request)
    {
        //TODO move implementation to the repository

        $filter = new Filter();

        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $products = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findByFilter($form->getData());

            $productImages = $this->getDoctrine()
                ->getRepository(ProductImage::class)
                ->findAll();

            return $this->render('homepage/main.html.twig', [
                'products' => $products,
                'productImages' => $productImages,
                'form' => $form->createView(),
            ]);
        }

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $productImages = $this->getDoctrine()
            ->getRepository(ProductImage::class)
            ->findAll();

        return $this->render('homepage/main.html.twig', [
            'products' => $products,
            'productImages' => $productImages,
            'form' => $form->createView(),
        ]);
    }

}
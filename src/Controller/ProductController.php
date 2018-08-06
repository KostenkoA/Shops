<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Entity\Product;
use App\Entity\ProductImage;
use App\Form\FilterType;
use App\Service\Filesystem\PathName;
use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * Generate all products list from DB, if defined filter generate filtered list of products
     *
     * @param Request $request
     * @param PathName $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getProductList(Request $request, PathName $path): Response
    {
        $doctrine = $this->getDoctrine();

        $products = $doctrine->getRepository(Product::class);

        $productImages = $doctrine->getRepository(ProductImage::class);

        $filter = new Filter();

        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            return $this->render('homepage/main.html.twig', [
                'products' => $products->findByFilter($form->getData()),
                'productImages' => $path->getNameFile($productImages->findAll()),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('homepage/main.html.twig', [
            'products' => $products->findAll(),
            'productImages' => $path->getNameFile($productImages->findAll()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * Generate preview product
     *
     * @param int $id
     * @param PathName $path
     * @return Response
     */
    public function getProductPreview(int $id, PathName $path): Response
    {
        //TODO refactoring
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->previewFindById($id)
        ;

        if (empty($product)){
            throw $this->createNotFoundException('Product with ID: '.$id.' not found!');
        }

        return $this->render('preview/productPreview.html.twig', [
            'product' => \array_shift($product),
            'productImages' => $path->getNameFile($product)
        ]);
    }

}
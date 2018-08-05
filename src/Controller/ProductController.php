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
     * @param Request $request
     * @param PathName $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getProductList(Request $request, PathName $path): Response
    {
        //TODO move implementation to the repository

        $products = $this->getDoctrine()
            ->getRepository(Product::class);

        $productImages = $this->getDoctrine()
            ->getRepository(ProductImage::class);

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
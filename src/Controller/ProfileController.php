<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductForm;
use App\Model\ProductModel;
use App\Service\Filesystem\PathName;
use App\Service\profile\AddProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProfileController extends AbstractController
{
    /**
     * addProduct method adds new product in DB
     *
     * @param Request $request
     * @param AddProduct $addProduct
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function addProduct(Request $request, AddProduct $addProduct): Response
    {
        $newProduct = new ProductModel();

        $form = $this->createForm(ProductForm::class, $newProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $newProduct = $form->getData();
            $addProduct->addItems($newProduct);

            return $this->render('profile/profile.html.twig', [
                'message' => 'Congratulation your product is added!'
            ]);
        }

        return $this->render('profile/profile.html.twig', [
            'addProduct' => $form->createView()
        ]);
    }
/*
    public function editProduct(int $id,Request $request): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->previewFindById($id)
            ;
        $product =  \array_shift($product);


        echo '<pre>';
        return new Response(var_dump($product));
        echo '</pre>';
        die;

        $editProduct = new ProductModel();
        $editProduct->setId($id);
        $editProduct->setName($product->getName());


        $form = $this->createForm(FormEditProduct::class, $editProduct);
        $form->handleRequest($request);


        if (empty($product)){
            throw $this->createNotFoundException('Product with ID: '.$id.' not found!');
        }


        return $this->render('profile/edit.html.twig', [
           'editProduct' => $form->createView()
        ]);
    }
*/
    /**
     * deleteProduct method delete product from DB
     *
     * @param int $id
     * @param PathName $pathName
     * @return Response
     */
    public function deleteProduct(int $id, PathName $pathName): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->previewFindById($id)
        ;

        if (empty($product)){
            throw $this->createNotFoundException('Product with ID: '.$id.' not found!');
        }

        $productInfo =  \array_shift($product);
        $imagesProducts = $product;

        $em = $this->getDoctrine()->getManager();
        $em->remove($productInfo);

        foreach ($imagesProducts as $image){
            $em->remove($image);
            \unlink($pathName->getUploadImagePath().$image->getImagePath());
        }
        $em->flush();
        return $this->redirectToRoute('homepage');

    }

}
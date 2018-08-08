<?php

namespace App\Controller;


use App\Entity\Product;
use App\Entity\ProductImage;
use App\Form\AddProduct;
use App\Model\AddProductModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AddProductController extends AbstractController
{
    public function addProduct(Request $request, \App\Service\profile\AddProduct $addProduct)
    {
        $newProduct = new AddProductModel();

        $form = $this->createForm(AddProduct::class, $newProduct);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){
            $newProduct = $form->getData();
            $addProduct->addItems($newProduct);


            echo '<pre>';
            return new Response(var_dump($newProduct));
            echo '</pre>';
            die;

            /*
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
*/
            return $this->render('profile/profile.html.twig', [
                'addProduct' => $form->createView()
            ]);
        }


        return $this->render('profile/profile.html.twig', [
            'addProduct' => $form->createView()
        ]);
    }

}
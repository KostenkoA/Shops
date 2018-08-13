<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductImage;
use App\Form\DeleteImageForm;
use App\Form\EditProductForm;
use App\Form\ProductForm;
use App\Model\ProductModel;
use App\Service\Filesystem\PathName;
use App\Service\profile\AddProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

            echo '<pre>';
            return new Response(var_dump($newProduct));
            echo '</pre>';
            die;

            $addProduct->addItems($newProduct);

            return $this->render('profile/profile.html.twig', [
                'message' => 'Congratulation your product is added!'
            ]);
        }

        return $this->render('profile/profile.html.twig', [
            'addProduct' => $form->createView()
        ]);
    }

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

    public function editProduct(int $id, Request $request, PathName $path, AddProduct $editProduct): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->previewFindById($id)
        ;

        $productInfo = \array_shift($product);
        $productImages = $product;

        $newEditProduct = new ProductModel();

        $newEditProduct->setId($id);
        $newEditProduct->setName($productInfo->getName());
        $newEditProduct->setTypeId($productInfo->getTypeId());
        $newEditProduct->setPrice($productInfo->getPrice());
        $newEditProduct->setComment($productInfo->getComment());


        $form = $this->createForm(EditProductForm::class, $newEditProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $newProduct = $form->getData();

           // $editProduct->updateItem($newProduct, $id);


            echo '<pre>';
            return new Response(var_dump($newProduct));
            echo '</pre>';
            die;


            return $this->render('profile/edit.html.twig', [
                'message' => 'Congratulation your product is edited!',
                'product' => $productInfo,
                'productImages' => $path->getNameFile($productImages)
            ]);

        }

        return $this->render('profile/edit.html.twig', [
            'editProduct' => $form->createView(),
            'product' => $productInfo,
            'productImages' => $path->getNameFile($productImages)
        ]);

    }

    public function deleteProductImage($id, PathName $pathName)
    {
        $productImage = $this->getDoctrine()->getRepository(ProductImage::class)
            ->find($id);

        if (empty($productImage)){
            throw $this->createNotFoundException('Product Image with ID: '.$id.' not found!');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($productImage);
        $em->flush();
        \unlink($pathName->getUploadImagePath().$productImage->getImagePath());

        return $this->redirectToRoute('profile_edit', [
            'id' => $productImage->getProductId()
        ]);

    }

    public function contact(Request $request)
    {

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->previewFindById(13)
        ;

        $productInfo = \array_shift($product);
        $productImages = $product;
/*
        echo '<pre>';
        return new Response(var_dump($productImages));
        echo '</pre>';
        die;
*/
      //  $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($productImages)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class);
        foreach ($productImages as $productImage){
            $form->add('photos', CheckboxType::class, [
                'data' => $productImage->getId()
            ]);
        }


        $form
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            return new Response(var_dump($data));
        }

        // ... render the form
        return $this->render('profile/contact.html.twig', [
            'editProduct' => $form->createView(),
        ]);
    }

}
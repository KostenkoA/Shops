<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Entity\Product;
use App\Entity\ProductImage;
use App\Form\DeleteImageForm;
use App\Form\EditProductForm;
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

        if (!empty($imagesProducts[0])) {
            foreach ($imagesProducts as $image) {
                $em->remove($image);
                \unlink($pathName->getUploadImagePath() . $image->getImagePath());
            }
        }
        $em->flush();
        return $this->redirectToRoute('homepage');

    }

    /**
     * editProduct method edit Product entity and add new files
     *
     * @param int $id
     * @param Request $request
     * @param PathName $path
     * @param AddProduct $editProduct
     * @return Response
     */
    public function editProduct(int $id, Request $request, PathName $path, AddProduct $editProduct): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->previewFindById($id)
        ;

        if (empty($product)){
            throw $this->createNotFoundException('Product with ID: '.$id.' not found!');
        }


        $productInfo = \array_shift($product);
        $productImages = $product;

        $newEditProduct = new ProductModel();
        $newEditProduct->setId($id);
        $newEditProduct->setName($productInfo->getName());
        $newEditProduct->setTypeId($productInfo->getName());
        $newEditProduct->setPrice($productInfo->getPrice());
        $newEditProduct->setComment($productInfo->getComment());


        $form = $this->createForm(EditProductForm::class, $newEditProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $newProduct = $form->getData();

            $editProduct->updateItem($newProduct, $id);

            return $this->redirectToRoute('profile_edit', [
                'id' => $id
            ]);
        }

        if (empty($productImages[0])){
            return $this->render('profile/edit.html.twig',[
                'messageImage' => 'Your product does not have images!',
                'editProduct' => $form->createView(),
                'product' => $productInfo,
            ]);
        }

        return $this->render('profile/edit.html.twig', [
            'editProduct' => $form->createView(),
            'product' => $productInfo,
            'productImages' => $path->getNameFile($productImages)
        ]);

    }

    /**
     * deleteProductImage method deletes name of image from db and delete file from directory
     *
     * @param $id
     * @param PathName $pathName
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProductImage($id, PathName $pathName)
    {
        $productImage = $this->getDoctrine()->getRepository(ProductImage::class)
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($productImage);
        $em->flush();


        if (\file_exists($pathName->getUploadImagePath() . $productImage->getImagePath())) {
            \unlink($pathName->getUploadImagePath() . $productImage->getImagePath());
        }

        return $this->redirectToRoute('profile_edit', [
            'id' => $productImage->getProductId()
        ]);
    }
}
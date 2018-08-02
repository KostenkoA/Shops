<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductImage;
use App\Entity\UsersPurchases;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    private $sum;
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBasketProducts()
    {
        $userPurchases = $this->getDoctrine()
            ->getRepository(UsersPurchases::class)
            ->findBy(['userId' => 1])
            ;

        if (empty($userPurchases)){
            throw $this->createNotFoundException('Your basket is empty!');
        }

        foreach ($userPurchases as $userPurchase) {

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($userPurchase->getProductId());

        $this->sum += $product->getPrice();

        $productImages = $this->getDoctrine()
            ->getRepository(ProductImage::class)
            ->findBy(['productId' => $userPurchase->getProductId()]);

        $basketList[] = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'comment' => $product->getComment(),
            'image' => $productImages[0]->getImagePath(),
        ];
        }

        return $this->render('basket/basketProductsList.html.twig', [
            'basketList' => $basketList,
            'sum' => $this->sum
        ]);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addProductBasket(int $id)
    {
        //TODO add realization for unique product

        $newPurchases = new UsersPurchases();
        $em = $this->getDoctrine()->getManager();

        $newPurchases->setUserId(1);
        $newPurchases->setProductId($id);
        $newPurchases->setCount(1);

        $em->persist($newPurchases);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProductBasket(int $id)
    {
        $productBasket = $this->getDoctrine()
            ->getRepository(UsersPurchases::class)
            ->findOneBy(['productId' => $id])
            ;

        if (empty($productBasket)){
            throw $this->createNotFoundException('Product with ID - '.$id.' not found!');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($productBasket);
        $em->flush();

        return $this->redirectToRoute('basket');
    }
}
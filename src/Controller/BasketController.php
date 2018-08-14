<?php

namespace App\Controller;

use App\Entity\ProductImage;
use App\Entity\UsersPurchases;
use App\Service\basket\BasketList;
use App\Service\basket\BasketListSum;
use App\Service\Filesystem\PathName;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends AbstractController
{


    /**
     * Generate basket products list at the users purchases
     *
     * @param BasketList $list
     * @param BasketListSum $sum
     * @param PathName $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBasketProducts(BasketList $list, BasketListSum $sum, PathName $path): Response
    {
        $userPurchases = $this->getDoctrine()
            ->getRepository(UsersPurchases::class)
            ->findBy(['userId' => 1])
            ;

        $basketList = $list->usersChoiceList($userPurchases);

        if (empty($basketList)){
            return $this->render('basket/basketProductsList.html.twig', [
                'message' => 'Your basket is empty!'
            ]);
        }

        foreach ($basketList as $list){
            $productInfo[] = \array_shift($list);
            $productImages[] = $list;
        }

        return $this->render('basket/basketProductsList.html.twig', array(
            'basketProductInfo' => $productInfo,
            'basketProductPhoto' => $path->getNameFile($productImages),
            'sum' => $sum->getSumPurchases($userPurchases),
        ));
    }

    /**
     * Action add product in basket
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addProductBasket(int $id): Response
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
     * Action delete product from basket
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProductBasket(int $id): Response
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
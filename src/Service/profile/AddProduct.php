<?php

namespace App\Service\profile;


use App\Entity\Product;
use App\Entity\ProductImage;
use App\Service\Filesystem\PathName;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddProduct
{
    private $em;
    private $pathName;
    private $newName;

    /**
     * AddProduct constructor.
     * @param EntityManagerInterface $em
     * @param PathName $pathName
     */
    public function __construct(EntityManagerInterface $em,  PathName $pathName)
    {
        $this->em = $em;
        $this->pathName = $pathName;
    }

    /**
     * addItems method add product in DB and upload file in category /images/
     *
     * @param object $newProduct
     */
    public function addItems(object $newProduct)
    {
        $product = new Product();


        $product->setName($newProduct->getName());
        $product->setPrice($newProduct->getPrice());
        $product->setTypeId($newProduct->getTypeId()->getId());
        $product->setComment($newProduct->getComment());
        $this->em->persist($product);
        $this->em->flush();

        foreach ($newProduct->getImagePath() as $image){
            $productImage = new ProductImage();
            $productImage->setProductId($product->getId());
            $productImage->setImagePath($image->getClientOriginalName());
            $this->em->persist($productImage);
            $this->em->flush();

            $this->newName = $image->getClientOriginalName();
            $this->upload($image);
        }
    }

    /**
     * upload method uploaded file
     *
     * @param UploadedFile $file
     * @return null
     */
    public function upload(UploadedFile $file)
    {
        try{
            $file->move($this->pathName->getUploadImagePath(), $this->newName);
        } catch (FileException $e){
            return null;
        }
    }

    public function updateItem(object $newProduct, $id)
    {

        $product = $this->em
            ->getRepository(Product::class)
            ->find($id);


        $product->setName($newProduct->getName());
        $product->setPrice($newProduct->getPrice());
        $product->setTypeId($newProduct->getTypeId()->getId());
        $product->setComment($newProduct->getComment());
        $this->em->flush();

        foreach ($newProduct->getImagePath() as $image){
            $productImage = new ProductImage();
            $productImage->setProductId($id);
            $productImage->setImagePath($image->getClientOriginalName());
            $this->em->persist($productImage);
            $this->em->flush();

            $this->newName = $image->getClientOriginalName();
            $this->upload($image);
        }

    }
}
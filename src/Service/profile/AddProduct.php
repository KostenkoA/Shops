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

    public function __construct(EntityManagerInterface $em,  PathName $pathName)
    {
        $this->em = $em;
        $this->pathName = $pathName;
    }

    public function addItems(object $newProduct)
    {
        $product = new Product();


        $product->setName($newProduct->getName());
        $product->setPrice($newProduct->getPrice());
        $product->setTypeId($newProduct->getTypeId());
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

    public function upload(UploadedFile $file)
    {
        try{
            $file->move($this->pathName->getUploadImagePath(), $this->newName);
        }catch (FileException $exception){
            return null;
        }
    }
}
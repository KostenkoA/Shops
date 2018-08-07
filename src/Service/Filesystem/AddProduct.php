<?php

namespace App\Service\Filesystem;


use Doctrine\ORM\EntityManagerInterface;

class AddProduct implements FilePathInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * FilePathInterface is the interface that should be implemented by classes who want to participate
     * in the generates path for nameFile in main directory
     *
     * @param array $nameFiles
     * @return array
     */
    public function getNameFile(array $nameFiles): array
    {
        // TODO: Implement getNameFile() method.
    }

    public function addItems(object $product)
    {
        // TODO
    }
}
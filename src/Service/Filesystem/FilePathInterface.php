<?php

namespace App\Service\Filesystem;


interface FilePathInterface
{
    /**
     * FilePathInterface is the interface that should be implemented by classes who want to participate
     * in the generates path for nameFile in main directory
     *
     * @param array $nameFiles
     * @return array
     */
    public function getNameFile(array $nameFiles): array;

}
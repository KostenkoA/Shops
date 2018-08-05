<?php

namespace App\Service\Filesystem;

class PathName implements FilePathInterface
{

    /**
     * FilePathInterface is the interface that should be implemented by classes who want to participate
     * in the generates path for nameFile in main directory
     *
     * @param array $nameFiles
     * @return array
     */
    public function getNameFile(array $nameFiles): array
    {
        foreach ($nameFiles as $nameFile){
            $nameFile->setImagePath(\sprintf('/images/%s',$nameFile->getImagePath()));
        }
        return $nameFiles;
    }

}
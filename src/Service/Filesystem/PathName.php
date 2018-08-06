<?php

namespace App\Service\Filesystem;

class PathName implements FilePathInterface
{
    private $imagePath;

    /**
     * PathName constructor.
     * @param $imagePath
     */
    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     *getNameFile method set image path in /images/ directory
     *
     * @param array $nameFiles
     * @return array
     */
    public function getNameFile(array $nameFiles): array
    {
        foreach ($nameFiles as $nameFile){
            $nameFile->setImagePath($this->getImagePath().$nameFile->getImagePath());
        }
        return $nameFiles;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

}
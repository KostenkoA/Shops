<?php

namespace App\Service\Filesystem;

class PathName implements FilePathInterface
{
    private $imagePath;
    private $uploadImagePath;

    /**
     * PathName constructor.
     * @param $imagePath
     * @param $uploadImagePath
     */
    public function __construct($imagePath, $uploadImagePath)
    {
        $this->imagePath = $imagePath;
        $this->uploadImagePath = $uploadImagePath;
    }

    /**
     *getNameFile method set image path in /images/ directory
     *
     * @param array $nameFiles
     *
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

    /**
     * @return string
     */
    public function getUploadImagePath(): string
    {
        return $this->uploadImagePath;
    }

}
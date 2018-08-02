<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilterRepository")
 */
class Filter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Search;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $priceFrom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceTo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameAscDesc;


    public function getId()
    {
        return $this->id;
    }

    public function getSearch(): ?string
    {
        return $this->Search;
    }

    public function setSearch(?string $Search): self
    {
        $this->Search = $Search;

        return $this;
    }

    public function getPriceFrom(): ?int
    {
        return $this->priceFrom;
    }

    public function setPriceFrom(?int $priceFrom): self
    {
        $this->priceFrom = $priceFrom;

        return $this;
    }

    public function getPriceTo(): ?int
    {
        return $this->priceTo;
    }

    public function setPriceTo(?int $priceTo): self
    {
        $this->priceTo = $priceTo;

        return $this;
    }

    public function getNameAscDesc(): ?string
    {
        return $this->nameAscDesc;
    }

    public function setNameAscDesc(string $nameAscDesc): self
    {
        $this->nameAscDesc = $nameAscDesc;

        return $this;
    }

}

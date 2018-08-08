<?php

namespace App\Model;

class Filter
{
    private $id;
    private $Search;
    private $priceFrom;
    private $priceTo;
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

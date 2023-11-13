<?php

namespace App\Modules\Invoices\Domain\Model\Entities;

use App\Domain\Model\Entity;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\Name;
use App\Modules\Invoices\Domain\Model\ValueObjects\Price;

class ProductItem extends Entity
{
    public function __construct(
        private Id    $id,
        private Name  $name,
        private Price $price
    )
    {
    }


    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
        ];
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }


}

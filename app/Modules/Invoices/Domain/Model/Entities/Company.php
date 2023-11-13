<?php

namespace App\Modules\Invoices\Domain\Model\Entities;

use App\Domain\Model\Entity;
use App\Modules\Invoices\Domain\Model\ValueObjects\City;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\Name;
use App\Modules\Invoices\Domain\Model\ValueObjects\Phone;
use App\Modules\Invoices\Domain\Model\ValueObjects\StreetAddress;
use App\Modules\Invoices\Domain\Model\ValueObjects\ZipCode;

class Company extends Entity
{
    public function __construct(
        private Id            $id,
        private Name          $name,
        private StreetAddress $streetAddress,
        private City          $city,
        private ZipCode       $zipCode,
        private Phone         $phone
    )
    {
    }


    public function toArray(): array
    {
        return [
          'id' => $this->getId()->value(),
          'name' => $this->getName()->value(),
          'streetAddress' => $this->getStreetAddress()->value(),
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

    public function getStreetAddress(): StreetAddress
    {
        return $this->streetAddress;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getZipCode(): ZipCode
    {
        return $this->zipCode;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

}

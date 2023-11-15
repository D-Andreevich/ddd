<?php

namespace App\Modules\Invoices\Domain\Factories;

use App\Modules\Invoices\Domain\Model\Entities\Company;
use App\Modules\Invoices\Domain\Model\ValueObjects\City;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\Name;
use App\Modules\Invoices\Domain\Model\ValueObjects\Phone;
use App\Modules\Invoices\Domain\Model\ValueObjects\StreetAddress;
use App\Modules\Invoices\Domain\Model\ValueObjects\ZipCode;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class CompanyFactory
{
    public static function new(array $attributes = null): Company
    {
        $attributes = $attributes ?: [];

        $faker = Factory::create();

        $defaults = [
            'id' => Uuid::uuid4()->toString(),
            'name' => $faker->company(),
            'street' => $faker->streetAddress(),
            'city' => $faker->city(),
            'zip' => $faker->postcode(),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->safeEmail(),
        ];

        $attributes = array_replace($defaults, $attributes);

        return new Company(
            id: new Id($attributes['id']),
            name: new Name($attributes['name']),
            streetAddress: new StreetAddress($attributes['street']),
            city: new City($attributes['city']),
            zipCode: new ZipCode($attributes['zip']),
            phone: new Phone($attributes['phone'])
        );
    }
}

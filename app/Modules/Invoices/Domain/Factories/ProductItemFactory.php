<?php

namespace App\Modules\Invoices\Domain\Factories;

use App\Domain\Enums\CurrencyEnum;
use App\Modules\Invoices\Domain\Model\Entities\ProductItem;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\Name;
use App\Modules\Invoices\Domain\Model\ValueObjects\Price;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class ProductItemFactory
{
    public static function new(array $attributes = null): ProductItem
    {
        $attributes = $attributes ?: [];

        $faker = Factory::create();

        $defaults = [
            'id' => Uuid::uuid4()->toString(),
            'name' => $faker->word(),
            'price' => $faker->numberBetween(1111, 9999999),
            'currency' => 'usd',
        ];

        $attributes = array_replace($defaults, $attributes);

        return new ProductItem(
            id: new Id($attributes['id']),
            name: new Name($attributes['name']),
            price: new Price($attributes['price'], CurrencyEnum::tryFrom($attributes['currency']))
        );
    }
}

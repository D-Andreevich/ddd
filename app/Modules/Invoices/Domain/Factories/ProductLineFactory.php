<?php

namespace App\Modules\Invoices\Domain\Factories;

use App\Modules\Invoices\Domain\Model\ValueObjects\ProductLine;
use App\Modules\Invoices\Domain\Model\ValueObjects\Quantity;
use Faker\Factory;

class ProductLineFactory
{
    public static function new(array $attributes = null): ProductLine
    {
        $attributes = $attributes ?: [];

        $faker = Factory::create();

        $defaults = [
            'quantity' => $faker->numberBetween(1, 100),
        ];

        $attributes = array_replace($defaults, $attributes);

        return new ProductLine(
            product: ProductItemFactory::new(),
            quantity: new Quantity($attributes['quantity'])
        );
    }
}

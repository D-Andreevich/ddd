<?php

namespace App\Modules\Invoices\Domain\Factories;

use App\Modules\Invoices\Domain\Model\ValueObjects\Products;
use Faker\Factory;

class ProductsFactory
{
    public static function new(array $attributes = null): Products
    {
        $attributes = $attributes ?: [];

        $faker = Factory::create();

        $defaults = [
            'quantity' => $faker->numberBetween(1, 5),
        ];

        $attributes = array_replace($defaults, $attributes);
        $products = [];
        for ($i = 0; $i < $attributes['quantity']; $i++) {
            $products[] = ProductLineFactory::new();
        }
        return new Products(
            $products
        );
    }
}

<?php

namespace App\Modules\Invoices\Domain\Model\ValueObjects;

use App\Domain\Model\ValueObjects\ValueObjectArray;

class Products extends ValueObjectArray
{
    /**
     * @var ProductLine[]
     */
    private readonly array $products;

    public function __construct(array $products)
    {
        parent::__construct($products);

        foreach ($products as $product) {
            if (!$product instanceof ProductLine) {
                throw new \InvalidArgumentException('Invalid ProductLine');
            }
        }
        $this->products = array_values($products);
    }

    public function add(ProductLine $product): void
    {
        $this->append($product);
    }

    public function __toString(): string
    {
        return implode(',', $this->products);
    }

    public function toArray(): array
    {
        return $this->products;
    }

    public function jsonSerialize(): array
    {
        return $this->products;
    }

    /**
     * @return ProductLine[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}

<?php

namespace App\Modules\Invoices\Domain\Model\ValueObjects;

use App\Domain\Enums\CurrencyEnum;
use App\Domain\Model\ValueObjects\ValueObjectInterface;
use App\Modules\Invoices\Domain\Model\Entities\ProductItem;

class ProductLine implements ValueObjectInterface
{
    private Price $totalPrice;

    public function __construct(
        private ProductItem $product,
        private Quantity    $quantity
    )
    {
        $this->recalculateTotalPrice();
    }

    private function recalculateTotalPrice(): void
    {
        $total = $this->getProduct()->getPrice()->getAmount() * $this->getQuantity()->value();

        $this->totalPrice = new Price($total, CurrencyEnum::USD);
    }

    public function getProduct(): ProductItem
    {
        return $this->product;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'product' => $this->getProduct(),
            'quantity' => $this->getQuantity(),
            'totalPrice' => $this->getTotalPrice(),
        ];
    }

    public function getTotalPrice(): Price
    {
        return $this->totalPrice;
    }

}

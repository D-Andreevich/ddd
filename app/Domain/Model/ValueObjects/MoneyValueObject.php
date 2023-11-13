<?php

namespace App\Domain\Model\ValueObjects;

use App\Domain\Enums\CurrencyEnum;

abstract class MoneyValueObject implements ValueObjectInterface
{
    public function __construct(
        protected int          $amount,
        protected CurrencyEnum $currency
    )
    {
    }

    public function jsonSerialize(): string
    {
        return "{$this->getAmount()} {$this->getCurrency()->value}";
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

}

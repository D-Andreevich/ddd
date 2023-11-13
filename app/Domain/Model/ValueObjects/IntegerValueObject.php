<?php

namespace App\Domain\Model\ValueObjects;

abstract class IntegerValueObject implements ValueObjectInterface
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromInteger(int $value): static
    {
        return new static($value);
    }

    public function __toString()
    {
        return (string)$this->value();
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isLessThan(IntegerValueObject $otherInt): bool
    {
        return $this->value() < $otherInt->value();
    }

    public function isZero(): bool
    {
        return 0 === $this->value();
    }

    public function equals(IntegerValueObject $otherInt): bool
    {
        return $this->value() === $otherInt->value();
    }

    public function jsonSerialize(): int
    {
        return $this->value();
    }
}

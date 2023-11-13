<?php

namespace App\Domain\Model\ValueObjects;

abstract class StringValueObject implements ValueObjectInterface
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function __toString()
    {
        return $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StringValueObject $otherString): bool
    {
        return $this->value === $otherString->value;
    }

    public function empty(): bool
    {
        return empty($this->value());
    }

    public function jsonSerialize(): string
    {
        return $this->value();
    }
}

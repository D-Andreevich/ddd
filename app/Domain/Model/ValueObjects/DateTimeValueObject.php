<?php

namespace App\Domain\Model\ValueObjects;

use DateTimeImmutable;
use DateTimeZone;

abstract class DateTimeValueObject extends DateTimeImmutable implements DateTimeInterface, ValueObjectInterface
{
    public static function fromPrimitives(string $datetime): static
    {
        return new static($datetime);
    }

    public static function now(): static
    {
        return new static('now');
    }

    public function value(): string
    {
        return $this->setTimezone(new DateTimeZone(static::DATETIME_ZONE))->format(static::DATETIME_FORMAT);
    }

    public function jsonSerialize(): string
    {
        return $this->value();
    }
}

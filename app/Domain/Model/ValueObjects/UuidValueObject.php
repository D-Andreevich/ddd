<?php

namespace App\Domain\Model\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Stringable;
use Symfony\Component\Uid\Ulid;

abstract class UuidValueObject implements Stringable, ValueObjectInterface
{
    private string $value;

    final public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    private function guard(string $value): void
    {
        if (false === Uuid::isValid($value)) {
            throw new InvalidArgumentException(sprintf('Value <%s> is not a valid UUID', $value));
        }
    }

    public static function create(): static
    {
        return new static((string) Uuid::uuid4());
    }

    public static function fromPrimitives(string $value): static
    {
        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value();
    }
}

<?php

namespace App\Domain\Model\ValueObjects;

abstract class ValueObjectArray extends \ArrayIterator implements \JsonSerializable
{
    abstract public function toArray(): array;

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

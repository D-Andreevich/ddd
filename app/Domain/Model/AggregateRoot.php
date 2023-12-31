<?php

namespace App\Domain\Model;

abstract class AggregateRoot
{
    abstract public function toArray(): array;

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

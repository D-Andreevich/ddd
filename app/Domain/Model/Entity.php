<?php

namespace App\Domain\Model;

use JsonSerializable;

abstract class Entity implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    abstract public function toArray(): array;
}

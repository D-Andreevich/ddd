<?php

namespace App\Domain\Exceptions;

final class ModificationProhibitedException extends \DomainException
{
    public function __construct()
    {
        parent::__construct("Entity can`t be changed");
    }
}

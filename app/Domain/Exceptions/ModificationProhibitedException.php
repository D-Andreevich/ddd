<?php

namespace App\Domain\Exceptions;

final class ModificationProhibitedException extends \LogicException
{
    public function __construct()
    {
        parent::__construct('Status can`t be changed');
    }
}

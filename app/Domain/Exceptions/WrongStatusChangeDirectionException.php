<?php

namespace App\Domain\Exceptions;

use BackedEnum;

final class WrongStatusChangeDirectionException extends \DomainException
{
    public function __construct(BackedEnum $currentStatus, BackedEnum $nextStatus)
    {
        parent::__construct(sprintf("Status %s can`t be changed to %s.", $currentStatus->value, $nextStatus->value));
    }
}

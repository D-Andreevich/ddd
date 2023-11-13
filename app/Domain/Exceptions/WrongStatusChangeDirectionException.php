<?php

namespace App\Domain\Exceptions;

use App\Domain\Model\ValueObjects\StatusValueObject;

final class WrongStatusChangeDirectionException extends \LogicException
{
    public function __construct(StatusValueObject $currentStatus, StatusValueObject $nextStatus)
    {
        parent::__construct("Status {$currentStatus->getName()} can`t be changed to {$nextStatus->getName()}");
    }
}

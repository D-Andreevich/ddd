<?php

namespace App\Domain\Exceptions;

final class EntityNotFoundException extends \DomainException
{
    protected $message = 'Entity not found';
}

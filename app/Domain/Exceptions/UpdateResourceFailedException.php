<?php

namespace App\Domain\Exceptions;


final class UpdateResourceFailedException extends \Exception
{
    protected $message = 'Failed to update Resource.';
}

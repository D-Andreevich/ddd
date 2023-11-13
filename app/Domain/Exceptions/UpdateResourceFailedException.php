<?php

namespace App\Domain\Exceptions;


class UpdateResourceFailedException extends \Exception
{
    protected $message = 'Failed to update Resource.';
}

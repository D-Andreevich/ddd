<?php

namespace App\Domain\Application\UseCases;

interface QueryInterface
{
    public function handle(): mixed;
}

<?php

namespace App\Modules\Invoices\Domain\Model\ValueObjects;

use App\Domain\Enums\StatusEnum;
use App\Domain\Model\ValueObjects\StatusValueObject;

class InvoiceStatusApprovedValueObject extends StatusValueObject
{
    protected \BackedEnum $name = StatusEnum::APPROVED;
    protected array $next = [];

    public function allowModification(): bool
    {
        return false;
    }
}

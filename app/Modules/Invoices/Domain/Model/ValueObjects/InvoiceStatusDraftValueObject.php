<?php

namespace App\Modules\Invoices\Domain\Model\ValueObjects;

use App\Domain\Enums\StatusEnum;
use App\Domain\Model\ValueObjects\StatusValueObject;

class InvoiceStatusDraftValueObject extends StatusValueObject
{
    protected \BackedEnum $name = StatusEnum::DRAFT;
    protected array $next = [InvoiceStatusApprovedValueObject::class, InvoiceStatusRejectedValueObject::class];
}

<?php

namespace App\Modules\Invoices\Domain\Factories;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Domain\Model\ValueObjects\InvoiceStatusApprovedValueObject;
use App\Modules\Invoices\Domain\Model\ValueObjects\InvoiceStatusDraftValueObject;
use App\Modules\Invoices\Domain\Model\ValueObjects\InvoiceStatusRejectedValueObject;

class StatusFactory
{
    public static function new(StatusEnum $enum): InvoiceStatusDraftValueObject|InvoiceStatusApprovedValueObject|InvoiceStatusRejectedValueObject
    {
        $class = match ($enum) {
            StatusEnum::DRAFT => InvoiceStatusDraftValueObject::class,
            StatusEnum::APPROVED => InvoiceStatusApprovedValueObject::class,
            StatusEnum::REJECTED => InvoiceStatusRejectedValueObject::class,
        };
        return new $class;
    }
}

<?php

namespace App\Modules\Invoices\Application\DTO;

use App\Domain\Enums\StatusEnum;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class ChangeStatusInvoiceData
{
    public function __construct(
        public UuidInterface $invoiceId,
        public StatusEnum    $status
    )
    {
    }

    public static function fromPrimitive(string $id, string $status)
    {
        return new self(
            Uuid::fromString($id),
            StatusEnum::tryFrom($status)
        );
    }
}

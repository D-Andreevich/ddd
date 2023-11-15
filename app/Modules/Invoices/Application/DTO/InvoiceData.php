<?php

namespace App\Modules\Invoices\Application\DTO;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class InvoiceData
{
    public function __construct(
        public UuidInterface $invoiceId
    )
    {
    }

    public static function fromPrimitives(string $id)
    {
        return new self(
            Uuid::fromString($id)
        );
    }
}

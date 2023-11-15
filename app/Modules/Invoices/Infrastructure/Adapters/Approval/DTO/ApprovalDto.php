<?php

namespace App\Modules\Invoices\Infrastructure\Adapters\Approval\DTO;

use App\Domain\Enums\StatusEnum;
use Ramsey\Uuid\UuidInterface;

final readonly class ApprovalDto
{
    /** @param class-string $entity */
    public function __construct(
        public UuidInterface $id,
        public StatusEnum    $status,
        public string        $entity,
    )
    {
    }
}

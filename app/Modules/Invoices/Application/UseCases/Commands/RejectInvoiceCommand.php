<?php

namespace App\Modules\Invoices\Application\UseCases\Commands;

use App\Domain\Application\UseCases\CommandInterface;
use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Application\DTO\InvoiceData;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;

final class RejectInvoiceCommand implements CommandInterface
{
    private readonly InvoiceRepositoryInterface $repository;
    private readonly StatusEnum $nextStatus;

    public function __construct(
        private readonly InvoiceData $invoiceData,

    )
    {
        $this->repository = app()->make(InvoiceRepositoryInterface::class);
        $this->nextStatus = StatusEnum::REJECTED;
    }

    public function execute()
    {
        $invoice = $this->repository->findById(Id::fromPrimitives($this->invoiceData->invoiceId->toString()));
        $invoice->changeStatus($this->nextStatus);
        $this->repository->persist($invoice);
    }
}

<?php

namespace App\Modules\Invoices\Application\UseCases\Queries;

use App\Domain\Application\UseCases\QueryInterface;
use App\Modules\Invoices\Application\DTO\InvoiceData;
use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;

final class FindInvoiceByIdQuery implements QueryInterface
{
    private InvoiceRepositoryInterface $repository;

    public function __construct(
        private readonly InvoiceData $invoiceData
    )
    {
        $this->repository = app()->make(InvoiceRepositoryInterface::class);
    }

    public function handle(): Invoice
    {
        return $this->repository->findById(new Id($this->invoiceData->invoiceId));
    }
}

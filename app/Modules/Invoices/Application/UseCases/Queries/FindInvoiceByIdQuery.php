<?php

namespace App\Modules\Invoices\Application\UseCases\Queries;

use App\Domain\UseCases\QueryInterface;
use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;

class FindInvoiceByIdQuery implements QueryInterface
{
    private InvoiceRepositoryInterface $repository;

    public function __construct(
        private readonly Id $id
    )
    {
        $this->repository = app()->make(InvoiceRepositoryInterface::class);
    }

    public function handle(): Invoice
    {
        return $this->repository->findById($this->id);
    }
}

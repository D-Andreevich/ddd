<?php

namespace App\Modules\Invoices\Domain\Repositories;

use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;

interface InvoiceRepositoryInterface
{
    public function update(Invoice $invoice): void;

    public function findById(Id $invoiceId): Invoice;

}

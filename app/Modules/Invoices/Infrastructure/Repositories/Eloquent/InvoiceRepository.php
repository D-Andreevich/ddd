<?php

namespace App\Modules\Invoices\Infrastructure\Repositories\Eloquent;

use App\Domain\Exceptions\UpdateResourceFailedException;
use App\Modules\Invoices\Application\Mappers\InvoiceMapper;
use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\EloquentModels\InvoiceEloquentModel;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @param Invoice $invoice
     * @return void
     * @throws UpdateResourceFailedException
     */
    public function update(Invoice $invoice): void
    {
        try {
            DB::beginTransaction();

            $invoiceEloquent = InvoiceMapper::toEloquent($invoice);
            $invoiceEloquent->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new UpdateResourceFailedException();
        }
    }

    /**
     * @param Id $invoiceId
     * @return Invoice
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findById(Id $invoiceId): Invoice
    {
        /** @var InvoiceEloquentModel $invoiceEloquent */
        $invoiceEloquent = InvoiceEloquentModel::query()->findOrFail($invoiceId->value());
        return InvoiceMapper::fromEloquent($invoiceEloquent);
    }
}

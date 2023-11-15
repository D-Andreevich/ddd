<?php

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Date;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\InvoiceNumber;
use App\Modules\Invoices\Domain\Model\ValueObjects\ProductLine;
use App\Modules\Invoices\Domain\Model\ValueObjects\Products;
use App\Modules\Invoices\Domain\Model\ValueObjects\Quantity;
use App\Modules\Invoices\Infrastructure\EloquentModels\InvoiceEloquentModel;

class InvoiceMapper
{

    public static function fromEloquent(InvoiceEloquentModel $eloquentModel): Invoice
    {
        $products = $eloquentModel->products->map(function ($product) {
            return new ProductLine(ProductItemMapper::fromEloquent($product), Quantity::fromInteger($product->pivot->quantity));
        });

        return new Invoice(
            invoiceId: new Id($eloquentModel->id),
            invoiceNumber: new InvoiceNumber($eloquentModel->number),
            statusEnum: $eloquentModel->status,
            invoiceDate: Date::fromPrimitives($eloquentModel->date),
            dueDate: Date::fromPrimitives($eloquentModel->due_date),
            products: new Products($products->toArray()),
            company: CompanyMapper::fromEloquent($eloquentModel->company),
        );
    }

    public static function toEloquent(InvoiceEloquentModel $invoiceEloquentModel, Invoice $invoice): InvoiceEloquentModel
    {
        $invoiceEloquentModel->status = $invoice->getStatus()->getName();
        $invoiceEloquentModel->date = $invoice->getDate();
        $invoiceEloquentModel->due_date = $invoice->getDueDate();
        return $invoiceEloquentModel;
    }
}

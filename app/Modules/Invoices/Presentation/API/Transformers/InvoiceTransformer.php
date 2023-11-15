<?php

namespace App\Modules\Invoices\Presentation\API\Transformers;

use App\Domain\Presentation\Transformers\TransformerAbstract;
use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\ProductLine;

class InvoiceTransformer extends TransformerAbstract
{
    public function transform(Invoice $invoice): array
    {
        $defaultDateFormat = 'Y-M-d';
        return [
            'invoiceNumber' => $invoice->getNumber(),
            'invoiceStatus' => $invoice->getStatus()->getName()->value,
            'invoiceDate' => $invoice->getDate()->format($defaultDateFormat),
            'invoiceDueDate' => $invoice->getDueDate()->format($defaultDateFormat),
            'company' => [
                'name' => $invoice->getCompany()->getName(),
                'streetAddress' => $invoice->getCompany()->getStreetAddress(),
                'city' => $invoice->getCompany()->getCity(),
                'zipCode' => $invoice->getCompany()->getZipCode(),
                'phone' => $invoice->getCompany()->getPhone()
            ],
            'products' => $this->getProducts($invoice->getProducts()->toArray()),
            'totalPrice' => $invoice->getTotalPrice()
        ];
    }

    private function getProducts(array $productsList): array
    {
        $result = [];

        /** @var ProductLine $line */
        foreach ($productsList as $line) {
            $result[] = [
                'name' => $line->getProduct()->getName(),
                'quantity' => $line->getQuantity(),
                'unitPrice' => $line->getProduct()->getPrice(),
                'total' => $line->getTotalPrice()
            ];
        }
        return $result;
    }
}

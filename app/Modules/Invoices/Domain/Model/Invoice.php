<?php

namespace App\Modules\Invoices\Domain\Model;

use App\Domain\Enums\CurrencyEnum;
use App\Domain\Enums\StatusEnum;
use App\Domain\Model\AggregateRoot;
use App\Domain\Model\ValueObjects\StatusValueObject;
use App\Modules\Invoices\Domain\Factories\StatusFactory;
use App\Modules\Invoices\Domain\Model\Entities\Company;
use App\Modules\Invoices\Domain\Model\ValueObjects\Date;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\InvoiceNumber;
use App\Modules\Invoices\Domain\Model\ValueObjects\Price;
use App\Modules\Invoices\Domain\Model\ValueObjects\ProductLine;
use App\Modules\Invoices\Domain\Model\ValueObjects\Products;

class Invoice extends AggregateRoot
{
    private Id $id;
    private InvoiceNumber $number;
    private StatusValueObject $status;
    private Date $date;
    private Date $dueDate;
    private Company $company;
    private Products $products;
    private Price $totalPrice;

    public function __construct(Id $invoiceId, InvoiceNumber $invoiceNumber, StatusEnum $statusEnum, Date $invoiceDate, Date $dueDate, Company $company, Products $products)
    {
        $this->id = $invoiceId;
        $this->number = $invoiceNumber;
        $this->status = StatusFactory::new($statusEnum);
        $this->date = $invoiceDate;
        $this->dueDate = $dueDate;
        $this->company = $company;
        $this->products = $products;

        $this->recalculateTotalPrice();
    }

    private function recalculateTotalPrice()
    {
        $total = array_reduce(
            $this->products->getProducts(),
            function ($total, $productLine) {
                /** @var ProductLine $productLine */
                return $total + $productLine->getTotalPrice()->getAmount();
            }, 0);

        $this->totalPrice = new Price($total, CurrencyEnum::USD);
    }

    public function getProducts(): Products
    {
        return $this->products;
    }

    public function getTotalPrice(): Price
    {
        return $this->totalPrice;
    }

    public function addProduct(ProductLine $productLine)
    {
        $this->status->ensureAllowsModification();
        $this->products->add($productLine);
        return $this;
    }

    public function changeStatus(StatusEnum $statusEnum)
    {
        $nextStatus = StatusFactory::new($statusEnum);
        $this->status->ensureCanBeChangedTo($nextStatus);
        $this->status = $nextStatus;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->value(),
            'number' => $this->getNumber()->value(),
            'status' => $this->getStatus(),
            'date' => $this->getDate()->value(),
            'dueDate' => $this->getDueDate()->value(),
            'company' => $this->getCompany(),
            'products' => $this->getProducts(),
            'totalPrice' => $this->getTotalPrice()->getAmount()
        ];
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getNumber(): InvoiceNumber
    {
        return $this->number;
    }

    public function getStatus(): StatusValueObject
    {
        return $this->status;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function getDueDate(): Date
    {
        return $this->dueDate;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }
}

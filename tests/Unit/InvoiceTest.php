<?php

namespace Tests\Unit;

use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\ModificationProhibitedException;
use App\Domain\Exceptions\WrongStatusChangeDirectionException;
use App\Modules\Invoices\Domain\Factories\InvoiceFactory;
use App\Modules\Invoices\Domain\Factories\ProductLineFactory;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    public function test_status_can_be_change_from_draft()
    {
        $invoice = InvoiceFactory::new(['status' => StatusEnum::DRAFT->value]);
        $invoice->changeStatus(StatusEnum::APPROVED);
        $this->assertTrue(true);
    }

    public function test_status_can_not_be_change_from_approved()
    {
        $invoice = InvoiceFactory::new(['status' => StatusEnum::APPROVED->value]);
        try {
            $invoice->changeStatus(StatusEnum::REJECTED);
        } catch (WrongStatusChangeDirectionException $exception) {
            $this->assertTrue(true);
        }
    }

    public function test_product_can_be_add_in_draft_status()
    {
        $invoice = InvoiceFactory::new(['status' => StatusEnum::DRAFT->value]);
        $product = ProductLineFactory::new(['quantity' => 2]);
        $invoice->addProduct($product);
        $this->assertTrue(true);
    }

    public function test_product_can_not_be_add_in_approved_status()
    {
        $invoice = InvoiceFactory::new(['status' => StatusEnum::APPROVED->value]);
        try {
            $product = ProductLineFactory::new(['quantity' => 2]);
            $invoice->addProduct($product);
        } catch (ModificationProhibitedException $exception) {
            $this->assertTrue(true);
        }
    }
}


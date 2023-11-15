<?php

namespace Tests\Feature;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Application\DTO\InvoiceData;
use App\Modules\Invoices\Application\UseCases\Commands\ApprovalInvoiceCommand;
use App\Modules\Invoices\Application\UseCases\Commands\RejectInvoiceCommand;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceCommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_approve_command()
    {
        $this->seed();
        $db = app(ConnectionInterface::class);

        $id = $db->table('invoices')->where('status', StatusEnum::DRAFT)->value('id');
        $data = InvoiceData::fromPrimitives($id);
        (new ApprovalInvoiceCommand($data))->execute();

        $currentStatusInDb = $db->table('invoices')->where('id', $id)->value('status');
        $this->assertTrue($currentStatusInDb === StatusEnum::APPROVED->value);
    }

    public function test_reject_command()
    {
        $this->seed();
        $db = app(ConnectionInterface::class);

        $id = $db->table('invoices')->where('status', StatusEnum::DRAFT)->value('id');

        $data = InvoiceData::fromPrimitives($id);
        (new RejectInvoiceCommand($data))->execute();

        $currentStatusInDb = $db->table('invoices')->where('id', $id)->value('status');
        $this->assertTrue($currentStatusInDb === StatusEnum::REJECTED->value);
    }
}

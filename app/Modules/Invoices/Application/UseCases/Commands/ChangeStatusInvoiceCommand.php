<?php

namespace App\Modules\Invoices\Application\UseCases\Commands;

use App\Domain\Application\UseCases\CommandInterface;
use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\WrongStatusChangeDirectionException;
use App\Modules\Invoices\Application\DTO\ChangeStatusInvoiceData;
use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\Adapters\Approval\ApprovalAdapter;
use App\Modules\Invoices\Infrastructure\Adapters\Approval\DTO\ApprovalDto;

final class ChangeStatusInvoiceCommand implements CommandInterface
{
    private readonly InvoiceRepositoryInterface $repository;
    private readonly ApprovalAdapter $approvalAdapter;


    public function __construct(
        private readonly ChangeStatusInvoiceData $changeStatusInvoiceData,

    )
    {
        $this->repository = app()->make(InvoiceRepositoryInterface::class);
        $this->approvalAdapter = app()->make(ApprovalAdapter::class);
    }

    public function execute(): void
    {
        $invoice = $this->repository->findById(Id::fromPrimitives($this->changeStatusInvoiceData->invoiceId->toString()));
        try {
            if ($this->changeStatusInvoiceData->status === StatusEnum::APPROVED) {
                $this->approvalAdapter->isApprovable(new ApprovalDto($this->changeStatusInvoiceData->invoiceId, $this->changeStatusInvoiceData->status, Invoice::class));
            }
            if ($this->changeStatusInvoiceData->status === StatusEnum::REJECTED) {
                $this->approvalAdapter->isRejectable(new ApprovalDto($this->changeStatusInvoiceData->invoiceId, $this->changeStatusInvoiceData->status, Invoice::class));
            }
        } catch (\LogicException $logicException) {
            throw new WrongStatusChangeDirectionException($invoice->getStatus()->getName(), $this->changeStatusInvoiceData->status);
        }

        $invoice->changeStatus($this->changeStatusInvoiceData->status);
        $this->repository->persist($invoice);
    }
}

<?php

namespace App\Modules\Invoices\Infrastructure\Adapters\Approval;

use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto as ExternalApprovalDto;
use App\Modules\Invoices\Infrastructure\Adapters\Approval\DTO\ApprovalDto as InternalApprovalDto;

class ApprovalAdapter
{
    public function __construct(
        private readonly ApprovalFacadeInterface $approvalApi
    )
    {
    }

    /**
     * @param InternalApprovalDto $data
     * @return true
     * @throws \LogicException
     */
    public function isApprovable(InternalApprovalDto $data): true
    {
        return $this->approvalApi->approve(new ExternalApprovalDto(
            $data->id,
            $data->status,
            $data->entity
        ));
    }

    /**
     * @param InternalApprovalDto $data
     * @return true
     * @throws \LogicException
     */
    public function isRejectable(InternalApprovalDto $data): true
    {
        return $this->approvalApi->reject(new ExternalApprovalDto(
            $data->id,
            $data->status,
            $data->entity
        ));
    }

}

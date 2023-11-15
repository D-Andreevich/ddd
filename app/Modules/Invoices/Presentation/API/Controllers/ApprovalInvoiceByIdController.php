<?php

namespace App\Modules\Invoices\Presentation\API\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\DTO\InvoiceData;
use App\Modules\Invoices\Application\UseCases\Commands\ApprovalInvoiceCommand;
use App\Modules\Invoices\Presentation\API\Requests\ApprovalInvoiceByIdRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApprovalInvoiceByIdController extends Controller
{
    public function __invoke(ApprovalInvoiceByIdRequest $request): JsonResponse
    {
        try {
            $invoiceData = InvoiceData::fromPrimitives($request->get('id'));
            (new ApprovalInvoiceCommand($invoiceData))->execute();
            return response()->json([], Response::HTTP_OK);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}

<?php

namespace App\Modules\Invoices\Presentation\API\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\DTO\InvoiceData;
use App\Modules\Invoices\Application\UseCases\Commands\RejectInvoiceCommand;
use App\Modules\Invoices\Presentation\API\Requests\RejectInvoiceByIdRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RejectInvoiceByIdController extends Controller
{
    public function __invoke(RejectInvoiceByIdRequest $request): JsonResponse
    {
        try {
            $invoiceData = InvoiceData::fromPrimitives($request->get('id'));
            (new RejectInvoiceCommand($invoiceData))->execute();
            return response()->json([], Response::HTTP_OK);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}

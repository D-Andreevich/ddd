<?php

namespace App\Modules\Invoices\Presentation\API\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\DTO\ChangeStatusInvoiceData;
use App\Modules\Invoices\Application\UseCases\Commands\ChangeStatusInvoiceCommand;
use App\Modules\Invoices\Presentation\API\Requests\ChangeStatusInvoiceByIdRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusInvoiceByIdController extends Controller
{
    public function __invoke(ChangeStatusInvoiceByIdRequest $request): JsonResponse
    {
        try {
            $data = ChangeStatusInvoiceData::fromPrimitive($request->id, $request->status);
            (new ChangeStatusInvoiceCommand($data))->execute();
            return response()->json([], Response::HTTP_OK);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}

<?php

namespace App\Modules\Invoices\Presentation\API\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\DTO\InvoiceData;
use App\Modules\Invoices\Application\UseCases\Queries\FindInvoiceByIdQuery;
use App\Modules\Invoices\Presentation\API\Requests\FindInvoiceByIdRequest;
use App\Modules\Invoices\Presentation\API\Transformers\InvoiceTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindInvoiceByIdController extends Controller
{
    public function __invoke(FindInvoiceByIdRequest $request): JsonResponse
    {
        try {
            $invoiceData = InvoiceData::fromPrimitives($request->get('id'));
            $invoice = (new FindInvoiceByIdQuery($invoiceData))->handle();
            return response()->json($this->transform($invoice, InvoiceTransformer::class), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

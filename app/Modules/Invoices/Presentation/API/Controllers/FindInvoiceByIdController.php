<?php

namespace App\Modules\Invoices\Presentation\API\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\UseCases\Queries\FindInvoiceByIdQuery;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Presentation\API\Requests\FindInvoiceByIdRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindInvoiceByIdController extends Controller
{
    public function __invoke(FindInvoiceByIdRequest $request): JsonResponse
    {
        try {
            $id = new Id($request->get('id'));
            $invoice = (new FindInvoiceByIdQuery($id))->handle();
            dd($invoice);
            return response()->json($invoice, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

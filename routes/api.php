<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/invoice/{id}', \App\Modules\Invoices\Presentation\API\Controllers\FindInvoiceByIdController::class);
Route::patch('/invoice/{id}/approve', \App\Modules\Invoices\Presentation\API\Controllers\ApprovalInvoiceByIdController::class);
Route::patch('/invoice/{id}/reject', \App\Modules\Invoices\Presentation\API\Controllers\RejectInvoiceByIdController::class);
Route::patch('/invoice/{id}/change-status', \App\Modules\Invoices\Presentation\API\Controllers\ChangeStatusInvoiceByIdController::class);

<?php

namespace App\Modules\Invoices\Presentation\API\Requests;

use Illuminate\Foundation\Http\FormRequest as LaravelRequest;

class ApprovalInvoiceByIdRequest extends LaravelRequest
{

    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }
}

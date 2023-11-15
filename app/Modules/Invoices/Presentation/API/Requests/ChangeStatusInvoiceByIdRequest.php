<?php

namespace App\Modules\Invoices\Presentation\API\Requests;

use App\Domain\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest as LaravelRequest;
use Illuminate\Validation\Rule;

class ChangeStatusInvoiceByIdRequest extends LaravelRequest
{

    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
            'status' => [
                'required',
                Rule::enum(StatusEnum::class)
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }
}

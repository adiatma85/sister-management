<?php

namespace App\Http\Requests;

use App\Models\Contract;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContractRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_create');
    }

    public function rules()
    {
        return [
            'sisters.*' => [
                'integer',
            ],
            'sisters' => [
                'required',
                'array',
            ],
            'clients.*' => [
                'integer',
            ],
            'clients' => [
                'required',
                'array',
            ],
        ];
    }
}

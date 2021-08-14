<?php

namespace App\Http\Requests;

use App\Models\Sister;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSisterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sister_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'province' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'sub_district' => [
                'string',
                'required',
            ],
            'ward' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'number' => [
                'string',
                'nullable',
            ],
            'age' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'required',
            ],
            'prefered_salary' => [
                'required',
            ],
            'type' => [
                'required',
            ],
        ];
    }
}

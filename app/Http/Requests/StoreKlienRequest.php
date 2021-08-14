<?php

namespace App\Http\Requests;

use App\Models\Klien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKlienRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('klien_create');
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
            // 'status' => [
            //     'required',
            // ],
            'number' => [
                'string',
                'nullable',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Klien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKlienRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('klien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:kliens,id',
        ];
    }
}

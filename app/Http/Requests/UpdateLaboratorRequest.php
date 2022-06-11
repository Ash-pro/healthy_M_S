<?php

namespace App\Http\Requests;

use App\Models\Laborator;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLaboratorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('laborator_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'specialty' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'birthday' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

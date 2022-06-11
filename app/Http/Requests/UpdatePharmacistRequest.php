<?php

namespace App\Http\Requests;

use App\Models\Pharmacist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePharmacistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pharmacist_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'age' => [
                'string',
                'required',
            ],
        ];
    }
}

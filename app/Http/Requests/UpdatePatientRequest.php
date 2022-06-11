<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'birthday' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'blood_type' => [
                'required',
            ],
            'chronic_diseases' => [
                'required',
            ],
        ];
    }
}

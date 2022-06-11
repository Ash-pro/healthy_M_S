<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_create');
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
            'specialty' => [
                'string',
                'required',
            ],
            'birthday' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'department_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

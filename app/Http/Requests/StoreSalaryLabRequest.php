<?php

namespace App\Http\Requests;

use App\Models\SalaryLab;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSalaryLabRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_lab_create');
    }

    public function rules()
    {
        return [
            'laboratories_id' => [
                'required',
                'integer',
            ],
            'salary' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

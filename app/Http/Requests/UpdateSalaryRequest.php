<?php

namespace App\Http\Requests;

use App\Models\Salary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSalaryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_edit');
    }

    public function rules()
    {
        return [
            'd_name_id' => [
                'required',
                'integer',
            ],
            'd_salary' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

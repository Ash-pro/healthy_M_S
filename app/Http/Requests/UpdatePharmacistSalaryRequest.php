<?php

namespace App\Http\Requests;

use App\Models\PharmacistSalary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePharmacistSalaryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pharmacist_salary_edit');
    }

    public function rules()
    {
        return [
            'p_name_id' => [
                'required',
                'integer',
            ],
            'p_salary' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

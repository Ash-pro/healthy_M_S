<?php

namespace App\Http\Requests;

use App\Models\DepartmentLab;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDepartmentLabRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('department_lab_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:2',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}

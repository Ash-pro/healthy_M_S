<?php

namespace App\Http\Requests;

use App\Models\DepartmentLab;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDepartmentLabRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('department_lab_create');
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

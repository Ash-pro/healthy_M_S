<?php

namespace App\Http\Requests;

use App\Models\DepartmentLab;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDepartmentLabRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('department_lab_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:department_labs,id',
        ];
    }
}

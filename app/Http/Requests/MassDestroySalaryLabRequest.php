<?php

namespace App\Http\Requests;

use App\Models\SalaryLab;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySalaryLabRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('salary_lab_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:salary_labs,id',
        ];
    }
}

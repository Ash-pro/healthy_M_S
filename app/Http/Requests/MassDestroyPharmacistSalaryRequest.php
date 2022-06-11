<?php

namespace App\Http\Requests;

use App\Models\PharmacistSalary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPharmacistSalaryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pharmacist_salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pharmacist_salaries,id',
        ];
    }
}

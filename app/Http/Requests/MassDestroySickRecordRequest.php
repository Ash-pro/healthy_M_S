<?php

namespace App\Http\Requests;

use App\Models\SickRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySickRecordRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sick_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sick_records,id',
        ];
    }
}

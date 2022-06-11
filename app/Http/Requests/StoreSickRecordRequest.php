<?php

namespace App\Http\Requests;

use App\Models\SickRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSickRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sick_record_create');
    }

    public function rules()
    {
        return [
            'p_name_id' => [
                'required',
                'integer',
            ],
            'reception_recording' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\CustomerPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_payment_edit');
    }

    public function rules()
    {
        return [
            'patient_id' => [
                'required',
                'integer',
            ],
            'date_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'payments' => [
                'required',
            ],
        ];
    }
}

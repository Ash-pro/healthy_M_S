@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customerPayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.id') }}
                        </th>
                        <td>
                            {{ $customerPayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.patient') }}
                        </th>
                        <td>
                            {{ $customerPayment->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.date_time') }}
                        </th>
                        <td>
                            {{ $customerPayment->date_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.payments') }}
                        </th>
                        <td>
                            {{ $customerPayment->payments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.doctor_revealed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $customerPayment->doctor_revealed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.lab_detection') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $customerPayment->lab_detection ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerPayment.fields.buy_medicine') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $customerPayment->buy_medicine ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
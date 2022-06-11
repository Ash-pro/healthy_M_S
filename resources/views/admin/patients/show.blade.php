@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.name') }}
                        </th>
                        <td>
                            {{ $patient->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.address') }}
                        </th>
                        <td>
                            {{ $patient->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.birthday') }}
                        </th>
                        <td>
                            {{ $patient->birthday }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.blood_type') }}
                        </th>
                        <td>
                            {{ App\Models\Patient::BLOOD_TYPE_SELECT[$patient->blood_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.chronic_diseases') }}
                        </th>
                        <td>
                            {{ App\Models\Patient::CHRONIC_DISEASES_RADIO[$patient->chronic_diseases] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.notes') }}
                        </th>
                        <td>
                            {!! $patient->notes !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#p_name_sick_records" role="tab" data-toggle="tab">
                {{ trans('cruds.sickRecord.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_customer_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.customerPayment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="p_name_sick_records">
            @includeIf('admin.patients.relationships.pNameSickRecords', ['sickRecords' => $patient->pNameSickRecords])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_customer_payments">
            @includeIf('admin.patients.relationships.patientCustomerPayments', ['customerPayments' => $patient->patientCustomerPayments])
        </div>
    </div>
</div>

@endsection
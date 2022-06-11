@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sickRecord.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sick-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sickRecord.fields.id') }}
                        </th>
                        <td>
                            {{ $sickRecord->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sickRecord.fields.p_name') }}
                        </th>
                        <td>
                            {{ $sickRecord->p_name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sickRecord.fields.reception_recording') }}
                        </th>
                        <td>
                            {{ $sickRecord->reception_recording }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sickRecord.fields.doctors_diagnosis') }}
                        </th>
                        <td>
                            {!! $sickRecord->doctors_diagnosis !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sickRecord.fields.laboratory_analysis') }}
                        </th>
                        <td>
                            {!! $sickRecord->laboratory_analysis !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sickRecord.fields.receiving_medicine') }}
                        </th>
                        <td>
                            {{ App\Models\SickRecord::RECEIVING_MEDICINE_RADIO[$sickRecord->receiving_medicine] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sick-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
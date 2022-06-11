@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pharmacistSalary.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacist-salaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.id') }}
                        </th>
                        <td>
                            {{ $pharmacistSalary->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.p_name') }}
                        </th>
                        <td>
                            {{ $pharmacistSalary->p_name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.p_salary') }}
                        </th>
                        <td>
                            {{ $pharmacistSalary->p_salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.date') }}
                        </th>
                        <td>
                            {{ $pharmacistSalary->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.notes') }}
                        </th>
                        <td>
                            {!! $pharmacistSalary->notes !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacist-salaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
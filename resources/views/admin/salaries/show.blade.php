@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.salary.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.id') }}
                        </th>
                        <td>
                            {{ $salary->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.d_name') }}
                        </th>
                        <td>
                            {{ $salary->d_name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.d_salary') }}
                        </th>
                        <td>
                            {{ $salary->d_salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.date') }}
                        </th>
                        <td>
                            {{ $salary->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.notes') }}
                        </th>
                        <td>
                            {!! $salary->notes !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.salaryLab.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salary-labs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryLab.fields.id') }}
                        </th>
                        <td>
                            {{ $salaryLab->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryLab.fields.laboratories') }}
                        </th>
                        <td>
                            {{ $salaryLab->laboratories->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryLab.fields.salary') }}
                        </th>
                        <td>
                            {{ $salaryLab->salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryLab.fields.date') }}
                        </th>
                        <td>
                            {{ $salaryLab->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryLab.fields.notes') }}
                        </th>
                        <td>
                            {!! $salaryLab->notes !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salary-labs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.departmentLab.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.department-labs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentLab.fields.id') }}
                        </th>
                        <td>
                            {{ $departmentLab->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentLab.fields.name') }}
                        </th>
                        <td>
                            {{ $departmentLab->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentLab.fields.description') }}
                        </th>
                        <td>
                            {!! $departmentLab->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.department-labs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.laborator.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.laborators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.id') }}
                        </th>
                        <td>
                            {{ $laborator->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.name') }}
                        </th>
                        <td>
                            {{ $laborator->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.specialty') }}
                        </th>
                        <td>
                            {{ $laborator->specialty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.address') }}
                        </th>
                        <td>
                            {{ $laborator->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.phone') }}
                        </th>
                        <td>
                            {{ $laborator->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.birthday') }}
                        </th>
                        <td>
                            {{ $laborator->birthday }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.laborator.fields.user_account') }}
                        </th>
                        <td>
                            {{ $laborator->user_account->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.laborators.index') }}">
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
            <a class="nav-link" href="#laboratories_salary_labs" role="tab" data-toggle="tab">
                {{ trans('cruds.salaryLab.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="laboratories_salary_labs">
            @includeIf('admin.laborators.relationships.laboratoriesSalaryLabs', ['salaryLabs' => $laborator->laboratoriesSalaryLabs])
        </div>
    </div>
</div>

@endsection
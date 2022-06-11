@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pharmacist.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacist.fields.id') }}
                        </th>
                        <td>
                            {{ $pharmacist->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacist.fields.name') }}
                        </th>
                        <td>
                            {{ $pharmacist->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacist.fields.phone') }}
                        </th>
                        <td>
                            {{ $pharmacist->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacist.fields.address') }}
                        </th>
                        <td>
                            {{ $pharmacist->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacist.fields.age') }}
                        </th>
                        <td>
                            {{ $pharmacist->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacist.fields.user_account') }}
                        </th>
                        <td>
                            {{ $pharmacist->user_account->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacists.index') }}">
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
            <a class="nav-link" href="#p_name_pharmacist_salaries" role="tab" data-toggle="tab">
                {{ trans('cruds.pharmacistSalary.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="p_name_pharmacist_salaries">
            @includeIf('admin.pharmacists.relationships.pNamePharmacistSalaries', ['pharmacistSalaries' => $pharmacist->pNamePharmacistSalaries])
        </div>
    </div>
</div>

@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.doctor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.update", [$doctor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $doctor->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $doctor->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specialty">{{ trans('cruds.doctor.fields.specialty') }}</label>
                <input class="form-control {{ $errors->has('specialty') ? 'is-invalid' : '' }}" type="text" name="specialty" id="specialty" value="{{ old('specialty', $doctor->specialty) }}" required>
                @if($errors->has('specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birthday">{{ trans('cruds.doctor.fields.birthday') }}</label>
                <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}" type="text" name="birthday" id="birthday" value="{{ old('birthday', $doctor->birthday) }}">
                @if($errors->has('birthday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birthday') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.birthday_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.doctor.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $doctor->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_account_id">{{ trans('cruds.doctor.fields.user_account') }}</label>
                <select class="form-control select2 {{ $errors->has('user_account') ? 'is-invalid' : '' }}" name="user_account_id" id="user_account_id">
                    @foreach($user_accounts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_account_id') ? old('user_account_id') : $doctor->user_account->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_account'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_account') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.user_account_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
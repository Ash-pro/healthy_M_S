@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.laborator.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.laborators.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.laborator.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.laborator.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specialty">{{ trans('cruds.laborator.fields.specialty') }}</label>
                <input class="form-control {{ $errors->has('specialty') ? 'is-invalid' : '' }}" type="text" name="specialty" id="specialty" value="{{ old('specialty', '') }}" required>
                @if($errors->has('specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.laborator.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.laborator.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.laborator.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.laborator.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.laborator.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birthday">{{ trans('cruds.laborator.fields.birthday') }}</label>
                <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}" type="text" name="birthday" id="birthday" value="{{ old('birthday') }}" required>
                @if($errors->has('birthday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birthday') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.laborator.fields.birthday_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_account_id">{{ trans('cruds.laborator.fields.user_account') }}</label>
                <select class="form-control select2 {{ $errors->has('user_account') ? 'is-invalid' : '' }}" name="user_account_id" id="user_account_id">
                    @foreach($user_accounts as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_account_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_account'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_account') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.laborator.fields.user_account_helper') }}</span>
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
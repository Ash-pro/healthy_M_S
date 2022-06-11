@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.customerPayment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customer-payments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.customerPayment.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPayment.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_time">{{ trans('cruds.customerPayment.fields.date_time') }}</label>
                <input class="form-control datetime {{ $errors->has('date_time') ? 'is-invalid' : '' }}" type="text" name="date_time" id="date_time" value="{{ old('date_time') }}" required>
                @if($errors->has('date_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPayment.fields.date_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payments">{{ trans('cruds.customerPayment.fields.payments') }}</label>
                <input class="form-control {{ $errors->has('payments') ? 'is-invalid' : '' }}" type="number" name="payments" id="payments" value="{{ old('payments', '') }}" step="0.01" required>
                @if($errors->has('payments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPayment.fields.payments_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('doctor_revealed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="doctor_revealed" value="0">
                    <input class="form-check-input" type="checkbox" name="doctor_revealed" id="doctor_revealed" value="1" {{ old('doctor_revealed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="doctor_revealed">{{ trans('cruds.customerPayment.fields.doctor_revealed') }}</label>
                </div>
                @if($errors->has('doctor_revealed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor_revealed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPayment.fields.doctor_revealed_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('lab_detection') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="lab_detection" value="0">
                    <input class="form-check-input" type="checkbox" name="lab_detection" id="lab_detection" value="1" {{ old('lab_detection', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="lab_detection">{{ trans('cruds.customerPayment.fields.lab_detection') }}</label>
                </div>
                @if($errors->has('lab_detection'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lab_detection') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPayment.fields.lab_detection_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('buy_medicine') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="buy_medicine" value="0">
                    <input class="form-check-input" type="checkbox" name="buy_medicine" id="buy_medicine" value="1" {{ old('buy_medicine', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="buy_medicine">{{ trans('cruds.customerPayment.fields.buy_medicine') }}</label>
                </div>
                @if($errors->has('buy_medicine'))
                    <div class="invalid-feedback">
                        {{ $errors->first('buy_medicine') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customerPayment.fields.buy_medicine_helper') }}</span>
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.patients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.patient.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birthday">{{ trans('cruds.patient.fields.birthday') }}</label>
                <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}" type="text" name="birthday" id="birthday" value="{{ old('birthday') }}" required>
                @if($errors->has('birthday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birthday') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.birthday_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.patient.fields.blood_type') }}</label>
                <select class="form-control {{ $errors->has('blood_type') ? 'is-invalid' : '' }}" name="blood_type" id="blood_type" required>
                    <option value disabled {{ old('blood_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Patient::BLOOD_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('blood_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('blood_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('blood_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.blood_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.patient.fields.chronic_diseases') }}</label>
                @foreach(App\Models\Patient::CHRONIC_DISEASES_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('chronic_diseases') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="chronic_diseases_{{ $key }}" name="chronic_diseases" value="{{ $key }}" {{ old('chronic_diseases', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="chronic_diseases_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('chronic_diseases'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chronic_diseases') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.chronic_diseases_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.patient.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes') !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.notes_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.patients.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $patient->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection
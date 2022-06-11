@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sickRecord.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sick-records.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="p_name_id">{{ trans('cruds.sickRecord.fields.p_name') }}</label>
                <select class="form-control select2 {{ $errors->has('p_name') ? 'is-invalid' : '' }}" name="p_name_id" id="p_name_id" required>
                    @foreach($p_names as $id => $entry)
                        <option value="{{ $id }}" {{ old('p_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('p_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('p_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sickRecord.fields.p_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reception_recording">{{ trans('cruds.sickRecord.fields.reception_recording') }}</label>
                <input class="form-control datetime {{ $errors->has('reception_recording') ? 'is-invalid' : '' }}" type="text" name="reception_recording" id="reception_recording" value="{{ old('reception_recording') }}">
                @if($errors->has('reception_recording'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reception_recording') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sickRecord.fields.reception_recording_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="doctors_diagnosis">{{ trans('cruds.sickRecord.fields.doctors_diagnosis') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('doctors_diagnosis') ? 'is-invalid' : '' }}" name="doctors_diagnosis" id="doctors_diagnosis">{!! old('doctors_diagnosis') !!}</textarea>
                @if($errors->has('doctors_diagnosis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctors_diagnosis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sickRecord.fields.doctors_diagnosis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="laboratory_analysis">{{ trans('cruds.sickRecord.fields.laboratory_analysis') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('laboratory_analysis') ? 'is-invalid' : '' }}" name="laboratory_analysis" id="laboratory_analysis">{!! old('laboratory_analysis') !!}</textarea>
                @if($errors->has('laboratory_analysis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('laboratory_analysis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sickRecord.fields.laboratory_analysis_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.sickRecord.fields.receiving_medicine') }}</label>
                @foreach(App\Models\SickRecord::RECEIVING_MEDICINE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('receiving_medicine') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="receiving_medicine_{{ $key }}" name="receiving_medicine" value="{{ $key }}" {{ old('receiving_medicine', 'no') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="receiving_medicine_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('receiving_medicine'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiving_medicine') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sickRecord.fields.receiving_medicine_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.sick-records.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $sickRecord->id ?? 0 }}');
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
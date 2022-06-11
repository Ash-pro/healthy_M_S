@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pharmacistSalary.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pharmacist-salaries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="p_name_id">{{ trans('cruds.pharmacistSalary.fields.p_name') }}</label>
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
                <span class="help-block">{{ trans('cruds.pharmacistSalary.fields.p_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="p_salary">{{ trans('cruds.pharmacistSalary.fields.p_salary') }}</label>
                <input class="form-control {{ $errors->has('p_salary') ? 'is-invalid' : '' }}" type="number" name="p_salary" id="p_salary" value="{{ old('p_salary', '') }}" step="0.01" required>
                @if($errors->has('p_salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('p_salary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacistSalary.fields.p_salary_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.pharmacistSalary.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacistSalary.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.pharmacistSalary.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes') !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacistSalary.fields.notes_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.pharmacist-salaries.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $pharmacistSalary->id ?? 0 }}');
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
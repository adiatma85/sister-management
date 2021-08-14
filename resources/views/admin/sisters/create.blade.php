@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sister.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sisters.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.sister.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="province">{{ trans('cruds.sister.fields.province') }}</label>
                <input class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}" type="text" name="province" id="province" value="{{ old('province', '') }}" required>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.sister.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sub_district">{{ trans('cruds.sister.fields.sub_district') }}</label>
                <input class="form-control {{ $errors->has('sub_district') ? 'is-invalid' : '' }}" type="text" name="sub_district" id="sub_district" value="{{ old('sub_district', '') }}" required>
                @if($errors->has('sub_district'))
                    <span class="text-danger">{{ $errors->first('sub_district') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.sub_district_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ward">{{ trans('cruds.sister.fields.ward') }}</label>
                <input class="form-control {{ $errors->has('ward') ? 'is-invalid' : '' }}" type="text" name="ward" id="ward" value="{{ old('ward', '') }}" required>
                @if($errors->has('ward'))
                    <span class="text-danger">{{ $errors->first('ward') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.ward_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.sister.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="number">{{ trans('cruds.sister.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text" name="number" id="number" value="{{ old('number', '') }}">
                @if($errors->has('number'))
                    <span class="text-danger">{{ $errors->first('number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="self_image">{{ trans('cruds.sister.fields.self_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('self_image') ? 'is-invalid' : '' }}" id="self_image-dropzone">
                </div>
                @if($errors->has('self_image'))
                    <span class="text-danger">{{ $errors->first('self_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.self_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ktp_image">{{ trans('cruds.sister.fields.ktp_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ktp_image') ? 'is-invalid' : '' }}" id="ktp_image-dropzone">
                </div>
                @if($errors->has('ktp_image'))
                    <span class="text-danger">{{ $errors->first('ktp_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.ktp_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="age">{{ trans('cruds.sister.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1" required>
                @if($errors->has('age'))
                    <span class="text-danger">{{ $errors->first('age') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.sister.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Sister::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'unknown') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prefered_salary">{{ trans('cruds.sister.fields.prefered_salary') }}</label>
                <input class="form-control {{ $errors->has('prefered_salary') ? 'is-invalid' : '' }}" type="number" name="prefered_salary" id="prefered_salary" value="{{ old('prefered_salary', '0') }}" step="0.01" required>
                @if($errors->has('prefered_salary'))
                    <span class="text-danger">{{ $errors->first('prefered_salary') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.prefered_salary_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.sister.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Sister::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sister.fields.type_helper') }}</span>
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
    var uploadedSelfImageMap = {}
Dropzone.options.selfImageDropzone = {
    url: '{{ route('admin.sisters.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="self_image[]" value="' + response.name + '">')
      uploadedSelfImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSelfImageMap[file.name]
      }
      $('form').find('input[name="self_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($sister) && $sister->self_image)
      var files = {!! json_encode($sister->self_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="self_image[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedKtpImageMap = {}
Dropzone.options.ktpImageDropzone = {
    url: '{{ route('admin.sisters.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="ktp_image[]" value="' + response.name + '">')
      uploadedKtpImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedKtpImageMap[file.name]
      }
      $('form').find('input[name="ktp_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($sister) && $sister->ktp_image)
      var files = {!! json_encode($sister->ktp_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="ktp_image[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
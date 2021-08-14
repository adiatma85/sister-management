@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contract.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contracts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="sisters">{{ trans('cruds.contract.fields.sister') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sisters') ? 'is-invalid' : '' }}" name="sisters[]" id="sisters" multiple required>
                    @foreach($sisters as $id => $sister)
                        <option value="{{ $id }}" {{ in_array($id, old('sisters', [])) ? 'selected' : '' }}>{{ $sister }}</option>
                    @endforeach
                </select>
                @if($errors->has('sisters'))
                    <span class="text-danger">{{ $errors->first('sisters') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.sister_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="clients">{{ trans('cruds.contract.fields.client') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]" id="clients" multiple required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ in_array($id, old('clients', [])) ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('clients'))
                    <span class="text-danger">{{ $errors->first('clients') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.client_helper') }}</span>
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
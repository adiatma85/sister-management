@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.klien.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kliens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.id') }}
                        </th>
                        <td>
                            {{ $klien->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.name') }}
                        </th>
                        <td>
                            {{ $klien->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.self_image') }}
                        </th>
                        <td>
                            @foreach($klien->self_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.province') }}
                        </th>
                        <td>
                            {{ $klien->province }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.city') }}
                        </th>
                        <td>
                            {{ $klien->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.sub_district') }}
                        </th>
                        <td>
                            {{ $klien->sub_district }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.ward') }}
                        </th>
                        <td>
                            {{ $klien->ward }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.number') }}
                        </th>
                        <td>
                            {{ $klien->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.klien.fields.address') }}
                        </th>
                        <td>
                            {{ $klien->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kliens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
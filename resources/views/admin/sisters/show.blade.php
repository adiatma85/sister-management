@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sister.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sisters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.id') }}
                        </th>
                        <td>
                            {{ $sister->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.name') }}
                        </th>
                        <td>
                            {{ $sister->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.address') }}
                        </th>
                        <td>
                            {{ $sister->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.number') }}
                        </th>
                        <td>
                            {{ $sister->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.self_image') }}
                        </th>
                        <td>
                            @foreach($sister->self_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.age') }}
                        </th>
                        <td>
                            {{ $sister->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Sister::STATUS_SELECT[$sister->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.prefered_salary') }}
                        </th>
                        <td>
                            {{ $sister->prefered_salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sister.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Sister::TYPE_SELECT[$sister->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sisters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
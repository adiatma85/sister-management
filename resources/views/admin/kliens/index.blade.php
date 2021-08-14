@extends('layouts.admin')
@section('content')
@can('klien_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kliens.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.klien.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.klien.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Klien">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.province') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.sub_district') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.ward') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.number') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.self_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.klien.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Klien::STATUS_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kliens as $key => $klien)
                        <tr data-entry-id="{{ $klien->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $klien->id ?? '' }}
                            </td>
                            <td>
                                {{ $klien->name ?? '' }}
                            </td>
                            <td>
                                {{ $klien->province ?? '' }}
                            </td>
                            <td>
                                {{ $klien->city ?? '' }}
                            </td>
                            <td>
                                {{ $klien->sub_district ?? '' }}
                            </td>
                            <td>
                                {{ $klien->ward ?? '' }}
                            </td>
                            <td>
                                {{ $klien->number ?? '' }}
                            </td>
                            <td>
                                {{ $klien->address ?? '' }}
                            </td>
                            <td>
                                @foreach($klien->self_image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\Klien::STATUS_SELECT[$klien->status] ?? '' }}
                            </td>
                            <td>
                                @can('klien_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kliens.show', $klien->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('klien_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kliens.edit', $klien->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('klien_delete')
                                    <form action="{{ route('admin.kliens.destroy', $klien->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('klien_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kliens.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Klien:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
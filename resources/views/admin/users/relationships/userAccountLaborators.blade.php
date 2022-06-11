@can('laborator_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.laborators.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.laborator.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.laborator.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userAccountLaborators">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.laborator.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.laborator.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.laborator.fields.specialty') }}
                        </th>
                        <th>
                            {{ trans('cruds.laborator.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.laborator.fields.user_account') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laborators as $key => $laborator)
                        <tr data-entry-id="{{ $laborator->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $laborator->id ?? '' }}
                            </td>
                            <td>
                                {{ $laborator->name ?? '' }}
                            </td>
                            <td>
                                {{ $laborator->specialty ?? '' }}
                            </td>
                            <td>
                                {{ $laborator->phone ?? '' }}
                            </td>
                            <td>
                                {{ $laborator->user_account->name ?? '' }}
                            </td>
                            <td>
                                @can('laborator_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.laborators.show', $laborator->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('laborator_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.laborators.edit', $laborator->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('laborator_delete')
                                    <form action="{{ route('admin.laborators.destroy', $laborator->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('laborator_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.laborators.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-userAccountLaborators:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
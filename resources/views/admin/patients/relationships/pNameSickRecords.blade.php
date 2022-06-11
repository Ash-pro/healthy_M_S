@can('sick_record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sick-records.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sickRecord.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.sickRecord.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-pNameSickRecords">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sickRecord.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.sickRecord.fields.p_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.sickRecord.fields.reception_recording') }}
                        </th>
                        <th>
                            {{ trans('cruds.sickRecord.fields.receiving_medicine') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sickRecords as $key => $sickRecord)
                        <tr data-entry-id="{{ $sickRecord->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sickRecord->id ?? '' }}
                            </td>
                            <td>
                                {{ $sickRecord->p_name->name ?? '' }}
                            </td>
                            <td>
                                {{ $sickRecord->reception_recording ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SickRecord::RECEIVING_MEDICINE_RADIO[$sickRecord->receiving_medicine] ?? '' }}
                            </td>
                            <td>
                                @can('sick_record_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sick-records.show', $sickRecord->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sick_record_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sick-records.edit', $sickRecord->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sick_record_delete')
                                    <form action="{{ route('admin.sick-records.destroy', $sickRecord->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sick_record_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sick-records.massDestroy') }}",
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
  let table = $('.datatable-pNameSickRecords:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
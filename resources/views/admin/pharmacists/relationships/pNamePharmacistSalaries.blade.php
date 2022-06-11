@can('pharmacist_salary_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pharmacist-salaries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pharmacistSalary.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.pharmacistSalary.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-pNamePharmacistSalaries">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.p_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.p_salary') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacistSalary.fields.date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pharmacistSalaries as $key => $pharmacistSalary)
                        <tr data-entry-id="{{ $pharmacistSalary->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pharmacistSalary->id ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacistSalary->p_name->name ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacistSalary->p_salary ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacistSalary->date ?? '' }}
                            </td>
                            <td>
                                @can('pharmacist_salary_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pharmacist-salaries.show', $pharmacistSalary->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pharmacist_salary_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pharmacist-salaries.edit', $pharmacistSalary->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pharmacist_salary_delete')
                                    <form action="{{ route('admin.pharmacist-salaries.destroy', $pharmacistSalary->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('pharmacist_salary_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pharmacist-salaries.massDestroy') }}",
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
  let table = $('.datatable-pNamePharmacistSalaries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
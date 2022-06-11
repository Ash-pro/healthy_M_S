@can('customer_payment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.customer-payments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customerPayment.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.customerPayment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientCustomerPayments">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.customerPayment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPayment.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPayment.fields.date_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerPayment.fields.payments') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerPayments as $key => $customerPayment)
                        <tr data-entry-id="{{ $customerPayment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $customerPayment->id ?? '' }}
                            </td>
                            <td>
                                {{ $customerPayment->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $customerPayment->date_time ?? '' }}
                            </td>
                            <td>
                                {{ $customerPayment->payments ?? '' }}
                            </td>
                            <td>
                                @can('customer_payment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.customer-payments.show', $customerPayment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('customer_payment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.customer-payments.edit', $customerPayment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('customer_payment_delete')
                                    <form action="{{ route('admin.customer-payments.destroy', $customerPayment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('customer_payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customer-payments.massDestroy') }}",
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
  let table = $('.datatable-patientCustomerPayments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
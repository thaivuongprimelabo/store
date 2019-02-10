

  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.orders.table_header.id') }}</th>
      <th>{{ trans('auth.orders.table_header.name') }}</th>
      <th>{{ trans('auth.orders.table_header.email') }}</th>
      <th>{{ trans('auth.orders.table_header.address') }}</th>
      <th>{{ trans('auth.orders.table_header.phone') }}</th>
      <th>{{ trans('auth.orders.table_header.status') }}</th>
      <th>{{ trans('auth.orders.table_header.created_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($orders->count())
    @foreach($orders as $order)
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->customer_name }}</td>
      <td>{{ $order->customer_email }}</td>
      <td>{{ $order->customer_address }}</td>
      <td>{{ $order->customer_phone }}</td>
      @if($order->status == Status::ORDER_NEW)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $order->id }}" data-status="{{ $order->status }}"><span class="label label-warning">{{ trans('auth.status.order_new') }}</span></a></td>
      @elseif($order->status == Status::ORDER_SHIPPING)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $order->id }}" data-status="{{ $order->status }}"><span class="label label-danger">{{ trans('auth.status.order_shipping') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $order->id }}" data-status="{{ $order->status }}"><span class="label label-success">{{ trans('auth.status.order_done') }}</span></a></td>
      @endif
      <td>{{ $order->created_at }}</td>
      @include('auth.common.row_button',[
      	'url2' => route('auth_orders_edit',['id' => $order->id])
      ])
    </tr>
    @endforeach
    @else
    <tr>
    	<td colspan="8" align="center">{{ trans('auth.no_data_found') }}</td>
    </tr>
    @endif
  </table>
<!-- /.box-body -->
<div class="box-footer clearfix">
  {{ $orders->links('auth.common.paging', ['paging' => $paging]) }}
</div>
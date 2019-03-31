<table class="table table-hover" style="table-layout: fixed; word-wrap:break-word;">
	<col width="5%">
    <col width="20%">
    <col width="20%">
    <col width="20%">
    <col width="10%">
    <col width="10%">
    <col width="10%">
    <col width="2%">
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
    @if($data_list->count())
    @foreach($data_list as $order)
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->customer_name }}</td>
      <td>{{ $order->customer_email }}</td>
      <td>{{ $order->customer_address }}</td>
      <td>{{ $order->customer_phone }}</td>
      @if($order->status == StatusOrders::ORDER_NEW)
      <td><span class="label label-warning">{{ trans('auth.status.order_new') }}</span></td>
      @elseif($order->status == StatusOrders::ORDER_SHIPPING)
      <td><span class="label label-danger">{{ trans('auth.status.order_shipping') }}</span></td>
      @else
      <td><span class="label label-success">{{ trans('auth.status.order_done') }}</span></td>
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

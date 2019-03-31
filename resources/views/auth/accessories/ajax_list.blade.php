<table class="table table-hover" style="table-layout: fixed; word-wrap:break-word;">
  	<col width="2%">
  	<col width="20%">
  	<col width="5%">
  	<col width="8%">
  	<col width="8%">
  	<col width="8%">
  	<col width="7%">
  	<col width="7%">
  	<col width="4%">
  	<col width="4%">
    <tr>
      <th>{{ trans('auth.products.table_header.id') }}</th>
      <th>{{ trans('auth.products.table_header.name') }}</th>
      <th>{{ trans('auth.products.table_header.image') }}</th>
      <th>{{ trans('auth.products.table_header.category') }}</th>
      <th>{{ trans('auth.products.table_header.vendor') }}</th>
      <th>{{ trans('auth.products.table_header.price') }}</th>
      <th>{{ trans('auth.products.table_header.status') }}</th>
      <th>{{ trans('auth.products.table_header.created_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($data_list->count())
    @foreach($data_list as $product)
    <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->name }}</td>
      <th><img src="{{ $product->getFirstImage($product->id) }}" width="{{ Common::IMAGE_WIDTH }}" title="{{ $product->description }}" alt="" /></th>
      <td>{{ $product->getCategoryName() }}</td>
      <td>{{ $product->getVendorName() }}</td>
      <td>{{ $product->getPrice($product->price) }}</td>
      @if($product->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="6" data-id="{{ $product->id }}" data-status="{{ $product->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="6" data-id="{{ $product->id }}" data-status="{{ $product->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $product->created_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_products_remove',['id' => $product->id]),
      	'url2' => route('auth_products_edit',['id' => $product->id])
      ])
    </tr>
    @endforeach
    @else
    <tr>
    	<td colspan="8" align="center">{{ trans('auth.no_data_found') }}</td>
    </tr>
    @endif
</table>

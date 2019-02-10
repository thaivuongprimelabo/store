  <table class="table table-hover">
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
    @if($products->count())
    @foreach($products as $product)
    <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->name }}</td>
      <th><img src="{{ $product->getFirstImage($product->id) }}" width="{{ Common::ADMIN_IMAGE_WIDTH }}" title="{{ $product->description }}" alt="{{ $product->name }}" /></th>
      <td>{{ $product->category_id }}</td>
      <td>{{ $product->vendor_id }}</td>
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
<!-- /.box-body -->
<div class="box-footer clearfix">
	{{ $products->links('auth.common.paging', ['paging' => $paging]) }}
</div>
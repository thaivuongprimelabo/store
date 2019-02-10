<table class="shopping-cart-table table">
<thead>
	<tr>
		<th>{{ trans('shop.cart.table.product') }}</th>
		<th></th>
		<th class="text-center">{{ trans('shop.cart.table.price') }}</th>
		<th class="text-center">{{ trans('shop.cart.table.quantity') }}</th>
		<th class="text-center">{{ trans('shop.cart.table.total_price') }}</th>
		<th class="text-right"></th>
	</tr>
</thead>
<tbody>
	@foreach($cart['items'] as $item)
	<tr>
		<td class="thumb"><img src="{{ Utils::getImageLink($item['image']) }}" alt=""></td>
		<td class="details">
			<a href="#">{{ $item['name'] }}</a>
			<ul>
				<li><span>Size: XL</span></li>
				<li><span>Color: Camelot</span></li>
			</ul>
		</td>
		<td class="price text-center">
			<strong>{{ number_format($item['price_discount']) }}</strong><br>
			@if($item['discount'])
			<del class="font-weak"><small>{{ number_format($item['price']) }}</small></del>
			@endif
		</td>
		<td class="qty text-center"><input class="input" type="number" value="{{ $item['qty'] }}" data-id="{{ $item['id'] }}"  min="1" max="50"></td>
		<td class="total text-center"><strong class="primary-color">{{ number_format($item['cost']) }}</strong></td>
		<td class="text-right"><button class="main-btn icon-btn" onclick="return removeItem('{{ route('cart.removeItem') }}', {{ $item['id'] }})"><i class="fa fa-close"></i></button></td>
	</tr>
	@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th class="empty" colspan="3"></th>
			<th>{{ trans('shop.cart.table.subtotal') }}</th>
			<th colspan="2" class="sub-total">{{ number_format($cart['sub_total']) }} </th>
		</tr>
		<tr>
			<th class="empty" colspan="3"></th>
			<th>{{ trans('shop.cart.table.shipping_fee') }}</th>
			<td colspan="2">{{ trans('shop.free_shipping') }}</td>
		</tr>
		<tr>
			<th class="empty" colspan="3"></th>
			<th>{{ trans('shop.cart.table.total') }}</th>
			<th colspan="2" class="total">{{ number_format($cart['total']) }}</th>
		</tr>
	</tfoot>
</table>
<div class="pull-right">
	<button class="primary-btn" onclick="return updateItem('{{ route('cart.updateItem') }}')">{{ trans('shop.button.update_qty') }}</button>
</div>

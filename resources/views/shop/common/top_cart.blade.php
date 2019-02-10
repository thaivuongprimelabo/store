<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
	<div class="header-btns-icon">
		<i class="fa fa-shopping-cart"></i>
		<span class="qty">{{ $cart['sum_item'] }}</span>
	</div>
	<strong class="text-uppercase">{{ trans('shop.cart.title') }}</strong>
	<br>
	<span>{{ number_format($cart['total']) }}</span>
</a>
@if($cart['total'])
<div class="custom-menu">
	<div id="shopping-cart">
		<div class="shopping-cart-list">
			@foreach($cart['items'] as $item)
			<div class="product product-widget">
				<div class="product-thumb">
					<img src="{{ Utils::getImageLink($item['image']) }}" alt="">
				</div>
				<div class="product-body">
					<h3 class="product-price">{{ number_format($item['price_discount']) }} <span class="qty">x{{ $item['qty'] }}</span></h3>
					<h2 class="product-name"><a href="#">{{ $item['name'] }}</a></h2>
				</div>
				<button class="cancel-btn"><i class="fa fa-trash"></i></button>
			</div>
			@endforeach
		</div>
		<div class="shopping-cart-btns">
			<button class="main-btn" onclick="window.location='{{ route('cart') }}'">{{ trans('shop.button.view_cart') }}</button>
			<button class="primary-btn" onclick="window.location='{{ route('cart') }}'">{{ trans('shop.button.checkout') }} <i class="fa fa-arrow-circle-right"></i></button>
		</div>
	</div>
</div>
@endif
@extends('layouts.shop')

@section('content')
<div class="container">
	<!-- row -->
	<div class="row">
		<!--  Product Details -->
		<div class="product product-details clearfix">
			<div class="col-md-6">
				<div id="product-main-view">
					@foreach($products as $product)
					<div class="product-view">
						<img src="{{ Utils::getImageLink($product->image) }}" alt="">
					</div>
					@endforeach
				</div>
				<div id="product-view">
					@foreach($products as $product)
					<div class="product-view">
						<img src="{{ Utils::getImageLink($product->image) }}" alt="">
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-body">
					<div class="product-label">
						@if($products->first()->is_new)
						<span>New</span>
						@endif
						@if($products->first()->discount)
						<span class="sale">-{{ $products->first()->discount }}%</span>
						@endif
					</div>
					<h2 class="product-name">{{ $products->first()->name }}</h2>
					@if($products->first()->discount)
					<h3 class="product-price">{{ $products->first()->getDiscount($products->first()->price, $products->first()->discount) }} <del class="product-old-price">{{ number_format($products->first()->price) }}</del></h3>
					@else
					
					@endif
					<p><strong>{{ trans('shop.availability') }}:</strong> {{ trans('shop.in_stock') }}</p>
					<p>{{ $products->first()->introduction }}</p>
					<div class="product-options">
						{!! $products->first()->getSizes($products->first()->sizes) !!}
						{!! $products->first()->getColors($products->first()->colors) !!}
					</div>

					<div class="product-btns">
						<div class="qty-input">
							<span class="text-uppercase">{{ trans('shop.qty') }}: </span>
							<input class="input" type="number" id="qty" value="1">
						</div>
						<button class="primary-btn add-to-cart"  onclick="return addItem('{{ route('cart.addItem') }}','{{ $product }}', document.getElementById('qty').value)"><i class="fa fa-shopping-cart"></i> {{ trans('shop.button.add_to_cart') }}</button>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="product-tab">
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">{{ trans('shop.details') }}</a></li>
						<li><a data-toggle="tab" href="#tab2">{{ trans('shop.another_products') }}</a></li>
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							{!! $products->first()->description !!}
						</div>
						<div id="tab2" class="tab-pane fade in">
							@include('shop.common.product',['title' => '', 'data' => $another_products])
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Product Details -->
	</div>
	<!-- /row -->
</div>
@endsection

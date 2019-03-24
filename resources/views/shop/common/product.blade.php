<!-- row -->
@if($data->count())
<div class="row">
	<!-- section title -->
	@if(!Utils::blank($title))
	<div class="col-md-12">
		<div class="section-title">
			<h2 class="title">{{ $title }}</h2>
		</div>
	</div>
	@endif
	<!-- section title -->
	@foreach($data as $product)
	<!-- Product Single -->
	<div class="col-md-3 col-sm-6 col-xs-6">
		<div class="product product-single">
			<div class="product-thumb">
				<div class="product-label">
					@if($product->is_new == Status::IS_NEW)
					<span>New</span>
					@endif
					@if($product->discount)
					<span class="sale">-{{ $product->discount }}%</span>
					@endif
				</div>
				<a href="{{ route('product_details', ['slug' => $product->category_name_url, 'slug2' => $product->name_url]) }}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> {{ trans('shop.quick_view') }}</a>
				<img src="{{ Utils::getImageLink($product->image) }}" alt="">
			</div>
			<div class="product-body">
				<h3 class="product-price">
					
					@if($product->discount)
						{{ $product->getDiscount($product->price, $product->discount) }}
						<del class="product-old-price">{{ number_format($product->price) }}</del>
					@else
						{{ number_format($product->price) }}
					@endif
				</h3>
				<div class="product-rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o empty"></i>
				</div>
				<h2 class="product-name"><a href="#">{{ $product->name }}</a></h2>
				<div class="product-btns">
					<button class="primary-btn add-to-cart" onclick="return addItem('{{ route('cart.addItem') }}','{{ $product }}')">
						<i class="fa fa-shopping-cart"></i> {{ trans('shop.button.add_to_cart') }}
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Product Single -->
	@endforeach
</div>
@endif
<!-- /row -->
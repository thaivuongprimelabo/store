@extends('layouts.shop')

@section('content')
<div class="container">
    <div class="row">
        <!-- ASIDE -->
        <div id="aside" class="col-md-3">
        	<div class="aside">
    			<h3 class="aside-title">{{ trans('shop.best_selling') }}</h3>
    			@foreach($best_selling_products as $product)
    			<!-- widget product -->
    			<div class="product product-widget">
    				<div class="product-thumb">
    					<img src="{{ $product->getFirstImage($product->id) }}" alt="">
    				</div>
    				<div class="product-body">
    					<h2 class="product-name"><a href="{{ route('product_details', ['slug' => $product->category_name_url, 'slug2' => $product->name_url]) }}">{{ $product->name }}</a></h2>
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
    				</div>
    			</div>
    			<!-- /widget product -->
    			@endforeach
    		</div>
    		<!-- /aside widget -->
    		<div class="aside">
    			<h3 class="aside-title">{{ trans('shop.discount_products') }}</h3>
    			@foreach($best_selling_products as $product)
    			<!-- widget product -->
    			<div class="product product-widget">
    				<div class="product-thumb">
    					<img src="{{ $product->getFirstImage($product->id) }}" alt="">
    				</div>
    				<div class="product-body">
    					<h2 class="product-name"><a href="{{ route('product_details', ['slug' => $product->category_name_url, 'slug2' => $product->name_url]) }}">{{ $product->name }}</a></h2>
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
    				</div>
    			</div>
    			<!-- /widget product -->
    			@endforeach
    		</div>
    		<!-- /aside widget -->
        </div>
        <div id="main" class="col-md-9">
        	<!-- store top filter -->
			<div class="store-filter clearfix">
				<div class="pull-left">
					<div class="sort-filter">
						<span class="text-uppercase">Sắp xếp:</span>
						<select class="input" id="sort">
							<option value="">Tất cả</option>
							<option value="price_asc">Giá tăng dần</option>
							<option value="price_desc">Giá giảm dần</option>
						</select>
						<a id="do_sort" href="javascript:void(0)" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></a>
					</div>
				</div>
				<div id="paging_link" class="pull-right">
				</div>
			</div>
			<!-- /store top filter -->
        	<div id="store">
        		<div id="product_list" class="row">
        			
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		loadProducts('{{ route('products') }}');
		$(document).on('click', '.page-number', function(e) {
			var page = $(this).attr('data-page');
			loadProducts('{{ route('products') }}?page=' + page);
		});

		$('#do_sort').click(function(e) {
			loadProducts('{{ route('products') }}');
		});
	})
</script>
@endsection

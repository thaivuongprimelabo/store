<div class="aside">
    <h3 class="aside-title">{{ $title }}</h3>
    @foreach($data as $product)
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
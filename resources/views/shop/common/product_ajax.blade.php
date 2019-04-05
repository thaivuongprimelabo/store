@if($data->count())
@foreach($data as $product)
@if($view_type == 'grid')
<div class="col-xs-6 col-xss-6 col-sm-4 col-md-4 col-lg-4">
	<div class="product-box">															
    	<div class="product-thumbnail flexbox-grid">	
    		<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
    			<img src="{{ $product->getFirstImage() }}" alt="{{ $product->getName() }}">
    		</a>	
    		<div class="product-action hidden-md hidden-sm hidden-xs clearfix">
				<div>
					<button class="btn-buy btn-cart btn btn-primary left-to add_to_cart" data-toggle="tooltip" title="Đặt hàng">
						<i class="fa fa-shopping-bag"></i>						
					</button>
					<a href="{{ $product->getLink() }}" data-handle="cherry-do-canada-loai-to" data-toggle="tooltip" title="Xem nhanh" class="btn-gray btn_view btn right-to quick-view">
						<i class="fa fa-eye"></i></a>
				</div>
    		</div>
    	</div>
    	<div class="product-info a-center">
    		<h3 class="product-name"><a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a></h3>
    		<div class="price-box clearfix">
    			<div class="special-price">
    				<span class="price product-price">{{ $product->getPrice() }}</span>
    			</div>											
    		</div>
    	</div>
    </div>
</div>
@else
<div class="col-xs-12">
	<div class="product-box clearfix">															
    	<div class="product-thumbnail f-left">	
    		<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
    			<img src="{{ $product->getFirstImage() }}" alt="{{ $product->getName() }}" style="width:{{ $product->getImageWidth() }}px; height:{{ $product->getImageHeight() }}px">
    		</a>	
    	</div>
    	<div class="product-info f-left">
    		<h3 class="product-name"><a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a></h3>
    		<div class="price-box clearfix">
    			<div class="special-price">
    				<span class="price product-price">{{ $product->getPrice() }}</span>
    			</div>											
    		</div>
    		<div class="product-summary margin-top-10">
				{{ $product->getSummary() }}
			</div>
			<form action="/cart/add" method="post" class="variants pro-action-btn margin-top-15" data-id="product-actions-11480175" enctype="multipart/form-data">
    			<input type="hidden" name="variantId" value="17898181">
    			<button class="btn-buy btn-cart btn btn-primary   left-to add_to_cart" title="Mua hàng"><span><!--<i class="fa fa-cart-plus" aria-hidden="true"></i>-->
    				Mua hàng</span>
    			</button>
    			<a href="/cherry-do-canada-loai-to" data-handle="cherry-do-canada-loai-to" class="btn-gray btn_view btn right-to quick-view"><i class="fa fa-search-plus"></i></a>
    		</form>
    	</div>
    </div>
</div>
@endif
@endforeach
@endif
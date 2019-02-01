@extends('layouts.shop')

@section('content')
<h3>{{ $products->first()->category_name }} </h3>
<div class="row-fluid">
  <ul class="thumbnails">
  	@foreach($products as $product)
	<li class="span4">
	  <div class="thumbnail">
		<a href="product_details.html" class="overlay"></a>
		<a class="zoomTool" href="product_details.html" title="add to cart"><span class="icon-search"></span> {{ trans('shop.button.detail_view') }}</a>
		<a href="product_details.html"><img src="{{ $product->getFirstImage($product->id) }}" alt=""></a>
		<div class="caption cntr">
			<p>{{ $product->name }}</p>
			<p><strong> {{ number_format($product->price) }}</strong></p>
			<h4><a class="shopBtn" href="#" title="add to cart"> {{ trans('shop.button.add_to_cart') }} </a></h4>
			<br class="clr">
		</div>
	  </div>
	</li>
	@endforeach
  </ul>
</div>
@endsection

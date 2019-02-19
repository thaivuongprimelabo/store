@extends('layouts.shop')

@section('content')
<!-- container -->
<div class="container">
	{!! Utils::createVendor() !!}
	@include('shop.common.product',['title' => trans('shop.new_products'), 'data' => $new_products])
	@include('shop.common.product',['title' => trans('shop.discount_products'), 'data' => $discount_products])
	@include('shop.common.product',['title' => trans('shop.best_selling'), 'data' => $best_selling_products])
</div>
<!-- /container -->
@endsection

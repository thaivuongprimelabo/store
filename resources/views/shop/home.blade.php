@extends('layouts.shop')

@section('content')
@include('shop.common.carousel')
	<!--
New Products
-->
	@include('shop.common.new_product')
	<!--
Featured Products
-->
	@include('shop.common.feature_product')
	
	@include('shop.common.popular_product')
	<hr>
	@include('shop.common.best_selling_product')
@endsection

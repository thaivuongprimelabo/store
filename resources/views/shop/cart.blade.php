@extends('layouts.shop')
@section('content')
@include('shop.common.breadcrumb')
<section class="main-cart-page main-container col1-layout">
	<div class="main container hidden-xs">
		<div id="main_cart" class="col-main cart_desktop_page cart-page">
			{!! $cart->getMainCart() !!}
		</div>

	</div>
</section>
@endsection

@extends('layouts.shop')

@section('content')
<!-- container -->
<div class="container">
	<div id="checkout-success" class="row" style="display: none">
		<div class="col-md-12">
			<div class="alert alert-success">
				<p style="font-size: 16px">CẢM ƠN BẠN ĐÃ ĐẶT HÀNG!</p>
				<p style="font-size: 16px">CHÚNG TÔI SẼ LIÊN LẠC NHANH NHẤT ĐỂ XÁC NHẬN ĐƠN HÀNG.</p>
				<hr/>
				<a href="/">Về trang chủ</a> | <a href="{{ route('products') }}">Trang sản phẩm</a>
			</div>
		</div>
	</div>
	<div id="cart" class="row">
    	<div class="col-md-12">
    			<div class="order-summary clearfix">
    				<div class="section-title">
    					<h3 class="title">{{ trans('shop.cart.title') }}</h3>
    				</div>
    				<div id="main-cart">
    				{!! Cart::mainCart() !!}
    				</div>
    			</div>
    	</div>
    	<div class="col-md-6">
    		<form role="form" id="create_form" action="?" method="post" enctype="multipart/form-data">
    			<div class="billing-details">
    				<div class="section-title">
    					<h3 class="title">{{ trans('shop.cart.payment.billing_details') }}</h3>
    				</div>
    				<div class="form-group">
    					<input class="input" type="text" name="name" maxlength="200" placeholder="{{ trans('shop.cart.payment.form.name') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="email" name="email" maxlength="200" placeholder="{{ trans('shop.cart.payment.form.email') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="text" name="address" maxlength="200" placeholder="{{ trans('shop.cart.payment.form.address') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="tel" name="tel" maxlength="15" placeholder="{{ trans('shop.cart.payment.form.phone') }}">
    				</div>
    				<div class="pull-right">
    					<button class="primary-btn" id="checkout">{{ trans('shop.button.checkout') }}</button>
    				</div>
    			</div>
			</form>
		</div>

		<div class="col-md-6">

			<div class="payments-methods">
				<div class="section-title">
					<h4 class="title">{{ trans('shop.cart.payment.shipping_methods') }}</h4>
				</div>
				<div class="input-checkbox">
					<input type="radio" name="payments" id="payments-1" value="bank_transfer" checked>
					<label for="payments-1">{{ trans('shop.cart.payment.bank_transfer') }}</label>
					<div class="caption">
						{!! $config['bank_info'] !!}
					</div>
				</div>
				<div class="input-checkbox">
					<input type="radio" name="payments" id="payments-2" value="cash">
					<label for="payments-2">{{ trans('shop.cart.payment.cod') }}</label>
					<div class="caption">
						{!! $config['cash_info'] !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /container -->
@endsection
@section('script')
<script type="text/javascript">
    var validator = $("#create_form").validate({
    	onfocusout: false,
    	rules: {
    		name: {
        		required: true
    		},
    		email: {
    			required: true,
    			email: true
    		},
    		address: {
    			required: true,
    		},
    		tel: {
    			required: true,
    			number: true
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
    		},
    		email : {
    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
    			email : "{{ trans('validation.email') }}"
    		},
    		address : {
    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
    		},
    		tel : {
    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
    			number: "{{ trans('validation.numeric') }}"
    		},
    	}
    });

    $('#checkout').click(function(e) {
		if($('#create_form').valid()) {
			checkout('{{ route('cart.checkout') }}');
		}

		return false;
    });
</script>
@endsection

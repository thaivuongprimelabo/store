@extends('layouts.shop')

@section('content')
<div class="container">
	@include('shop.common.alert')
	@if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
	<div class="row">
		<div class="col-md-6">
    		<form role="form" id="login_form" action="?" method="post" enctype="multipart/form-data">
    			{{ csrf_field() }}
    			<div class="billing-details">
    				<div class="section-title">
    					<h3 class="title">{{ trans('shop.login') }}</h3>
    				</div>
    				<div class="form-group">
    					<input class="input" type="email" name="email" maxlength="191" placeholder="{{ trans('shop.login_form.email') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="password" name="password" maxlength="40" placeholder="{{ trans('shop.login_form.password') }}">
    				</div>
    				<div class="pull-right">
    					<button class="primary-btn">{{ trans('shop.button.login') }}</button>
    				</div>
    			</div>
			</form>
		</div>
		<div class="col-md-6">
    		<form role="form" id="register_form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
    			{{ csrf_field() }}
    			<div class="billing-details">
    				<div class="section-title">
    					<h3 class="title">{{ trans('shop.register') }}</h3>
    				</div>
    				<div class="form-group">
    					<input class="input" type="text" name="name" maxlength="191" placeholder="{{ trans('shop.register_form.name') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="email" name="email" maxlength="191" placeholder="{{ trans('shop.register_form.email') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="password" id="password" name="password" maxlength="40" placeholder="{{ trans('shop.register_form.password') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="password" name="conf_password" maxlength="40" placeholder="{{ trans('shop.register_form.conf_password') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="tel" name="phone" maxlength="20" placeholder="{{ trans('shop.register_form.phone') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="text" name="address" maxlength="255" placeholder="{{ trans('shop.register_form.address') }}">
    				</div>
    				<div class="form-group captcha">
    					<span id="captcha-img">{!! captcha_img('flat') !!}</span>
    					<button id="refresh" type="button" class="btn btn-success"><i class="fa fa-refresh"></i></button>
    					<input class="input" type="text" id="captcha" name="captcha" maxlength="255" placeholder="{{ trans('shop.register_form.captcha') }}">
    					<span id="captcha-error" class="valid-text"></span>
    				</div>
    				<div class="pull-right">
    					<button type="button" class="primary-btn" id="register">{{ trans('shop.button.register') }}</button>
    				</div>
    			</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		var validatorLogin = $("#login_form").validate({
	    	onfocusout: false,
	    	rules: {
	    		email: {
	    			required: true,
	    			email: true
	    		},
	    		password: {
					required: true
	    		}
	    	},
	    	messages: {
	    		email : {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    			email : "{{ trans('validation.email') }}"
	    		},
	    		password: {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    		}
	    	},
	    	submitHandler: function(form) {
	    		form.submit();
	        }
	    });

	    var validatorReg = $("#register_form").validate({
	    	onfocusout: false,
	    	rules: {
	    		name: {
	        		required: true
	    		},
	    		email: {
	    			required: true,
	    			email: true
	    		},
	    		phone: {
	    			required: true,
	    			number: true
	    		},
	    		password: {
					required: true
	    		},
	    		conf_password: {
					required: true,
					equalTo: '#password'
	    		},
	    		address: {
					required: true
	    		},
	    		captcha: {
	    			required: true
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
	    		phone : {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    			number: "{{ trans('validation.numeric') }}"
	    		},
	    		password: {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    		},
	    		conf_password: {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    			equalTo: '{{ Utils::getValidateMessage('validation.password_match', '') }}'
	    		},
	    		address: {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    		},
	    		captcha: {
	    			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
	    		}
	    	},
	    	submitHandler: function(form) {
	    		form.submit();
	        }
	    });
	    
		$('#refresh').click(function(){
		  $.ajax({
		     type:'GET',
		     url:'{{ route('refreshcaptcha') }}',
		     success:function(data){
		        $("#captcha-img").html(data.captcha);
		     }
		  });
		});

		$('#register').click(function(){
			 if($("#register_form").valid()) {
				 var data = {
					type : 'post',
					async : false,
					page: 'checkcaptcha',
					captcha: $('#captcha').val(),
					container: '#captcha-error',
					new_captcha: '#captcha-img'
				 }


				 if(checkCaptcha('{{ route('checkCaptcha') }}', data)) {
					 $("#register_form").submit();
				 }

			 }
		});
	});

</script>
@endsection

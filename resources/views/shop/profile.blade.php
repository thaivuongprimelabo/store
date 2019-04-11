@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div id="register_success" class="alert alert-success" style="display:none">
    </div>
    <div id="register_error" class="alert alert-danger" style="display:none">
    </div>
	<h1 class="title-head"><a href="#">{{ trans('shop.profile_txt') }}</a></h1>
	<div class="row">
		<div class="col-lg-12 ">
			<div class="page-login">
				<div id="login">
					<form accept-charset="UTF-8" action="?" id="submit_form" method="post">
    					<div class="form-signup clearfix">
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.name') }}: </label>
    									<input type="text" class="form-control form-control-lg" value="" name="name" id="register_name" placeholder="{{ trans('shop.user.name') }}" maxlength="200" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.email') }}: </label>
    									<input type="email" class="form-control form-control-lg" value="" name="email" id="register_email" placeholder="{{ trans('shop.user.email') }}" maxlength="150" required="">
    								</fieldset>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.password') }}: </label>
    									<input type="password" class="form-control form-control-lg" value="" name="password" id="register_password" placeholder="{{ trans('shop.user.password') }}" maxlength="40" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.conf_password') }}: </label>
    									<input type="password" class="form-control form-control-lg" value="" name="conf_password" id="register_conf_password" placeholder="{{ trans('shop.user.conf_password') }}" maxlength="40" required="">
    								</fieldset>
    							</div>
    						</div>
    						
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label><span id="captcha_img">{!! captcha_img('flat') !!}</span> <button type="button" id="reset_captcha" class="btn btn-primary"><i class="fa fa-refresh"></i></button></label>
    									<input type="text" class="form-control form-control-lg" value="" name="captcha" id="register_captcha" placeholder="{{ trans('shop.user.captcha') }}" maxlength="3" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.phone') }}: </label>
    									<input type="tel" class="form-control form-control-lg" value="" name="phone" id="register_phone" placeholder="{{ trans('shop.user.phone') }}" maxlength="15" required="">
    								</fieldset>
    							</div>
    						</div>
    
    
    						<div class="col-xs-12 text-xs-left margin-bottom-30" style="margin-top:6px; padding: 0">
    							<button type="button" id="register_btn" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.register') }}">{{ trans('shop.button.register') }}</button>
    							<a href="{{ route('account_login') }}" class="btn-link-style btn-register" style="margin-left: 20px;text-decoration: underline; ">{{ trans('shop.button.login') }}</a>
    						</div>
    					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {

	$('#register_btn').click(function() {
    	var data = {
    		type : 'post',
    		async : true,
    		container: ['#register_success', '#register_error'],
    		name: $('#register_name').val(),
    		email: $('#register_email').val(),
    		password: $('#register_password').val(),
    		conf_password: $('#register_conf_password').val(),
    		phone: $('#register_phone').val(),
    		captcha: $('#register_captcha').val(),
    	}

    	$('#register_error').hide();
    
    	callAjax('{{ route('account_register') }}', data, $(this));
	});

	$('#reset_captcha').click(function() {

		refreshCaptcha('{{ route('refreshcaptcha') }}');
	});
});
</script>
@endsection
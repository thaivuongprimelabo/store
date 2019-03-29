@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.members.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_members') }}">{{ trans('auth.sidebar.products.members') }}</a></li>
    <li class="active">{{ trans('auth.members.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="1" />
			<input type="hidden" id="demension" value="{{ $config['avatar_image_size'] }}" />
			<input type="hidden" id="upload_limit" value="{{ $config['avatar_maximum_upload'] }}" />
			@include('auth.common.edit_form',['forms' => trans('auth.members.form'), 'data' => $member])
			@include('auth.common.button_footer',['back_url' => route('auth_members')])
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    var validatorEventSetting = $("#submit_form").validate({
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: {
    		name: {
    			required: true,
    		},
    		email: {
				required: true,
				email: true
    		},
    		password: {
    		},
    		conf_password: {
				equalTo: '#password'
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.members.form.name') }}",
    		},
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.members.form.name') }}",
    		},
    		email : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.members.form.email') }}",
    			email: "{{ Utils::getValidateMessage('validation.email') }}",
    		},
    		password : {
    		},
    		conf_password : {
    			equalTo: "{{ Utils::getValidateMessage('validation.confirmed', 'auth.members.form.conf_password.text', 'auth.members.form.password.text') }}"
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.users.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_users') }}">{{ trans('auth.sidebar.users') }}</a></li>
    <li class="active">{{ trans('auth.users.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				<input type="hidden" id="demension" value="{{ $config['avatar_image_size'] }}" />
				<input type="hidden" id="upload_limit" value="{{ $config['avatar_maximum_upload'] }}" />
    			@include('auth.common.alert')
                @include('auth.common.edit_form',['forms' => trans('auth.profile.form'), 'data' => Auth::user()])
                @include('auth.common.button_footer',['back_url' => route('auth_users')])
            </form>
            <!-- /.box -->
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    var validatorEventSetting = $("#submit_form").validate({
    	ignore: ":hidden:not(input[type='file'])",
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: {
    		name: {
    			required: true,
    			maxlength: {{  Common::NAME_MAXLENGTH }},
    		},
    		password: {
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
    		},
    		conf_password: {
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
				equalTo: '#password'
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		password : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.password.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.password.text', Common::PASSWORD_MAXLENGTH) }}",
    		},
    		conf_password : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.conf_password.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.conf_password.text', Common::PASSWORD_MAXLENGTH) }}",
    			equalTo: "{{ Utils::getValidateMessage('validation.confirmed', 'auth.users.form.conf_password.text', 'auth.users.form.password.text') }}"
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	}
    });
</script>
@endsection
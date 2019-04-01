@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				<input type="hidden" id="table" value="4" />
				@if(isset($data) && $data->id)
    			@include('auth.common.edit_form')
    			@else
    			@include('auth.common.create_form')
    			@endif
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
	@if(isset($data) && $data->id)
		var rules = {
    		name: {
    			required: true,
    		},
    		email: {
				required: true,
				email: true,
    		},
    		conf_password: {
				equalTo: '#password'
    		},
    };

    var messages = {
		name : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.name') }}",
		},
		email : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.email') }}",
			email: "{{ Utils::getValidateMessage('validation.email') }}",
		},
		conf_password : {
			equalTo: "{{ Utils::getValidateMessage('validation.confirmed', 'auth.users.form.conf_password.text', 'auth.users.form.password.text') }}"
		},
    };
	@else
	var rules = {
    		name: {
    			required: true,
    		},
    		email: {
				required: true,
				email: true,
    		},
    		password: {
				required: true,
    		},
    		conf_password: {
    			required: true,
				equalTo: '#password'
    		},
    };

    var messages = {
		name : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.name') }}",
		},
		email : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.email') }}",
			email: "{{ Utils::getValidateMessage('validation.email') }}",
		},
		password : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.password.text') }}",
		},
		conf_password : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.conf_password.text') }}",
			equalTo: "{{ Utils::getValidateMessage('validation.confirmed', 'auth.users.form.conf_password.text', 'auth.users.form.password.text') }}"
		},
    };
    @endif
    
    var validatorEventSetting = $("#submit_form").validate({
    	ignore: ":hidden:not(input[type='file'])",
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: rules,
    	messages: messages,
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });
</script>
@endsection
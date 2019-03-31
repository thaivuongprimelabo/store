@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="1" />
			@include('auth.common.create_form')
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
				required: true,
    		},
    		conf_password: {
    			required: true,
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
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.members.form.password.text') }}",
    		},
    		conf_password : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.members.form.conf_password.text') }}",
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
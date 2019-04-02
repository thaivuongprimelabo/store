@extends('layouts.app')

@section('content')
@include('auth.common.content_header')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
    			@include('auth.common.edit_form')
            </form>
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
    		},
    		password: {
    		},
    		conf_password: {
				equalTo: '#password'
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.name') }}",
    		},
    		password : {
    		},
    		conf_password : {
    			equalTo: "{{ Utils::getValidateMessage('validation.confirmed', 'auth.users.form.conf_password.text', 'auth.users.form.password.text') }}"
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	}
    });
</script>
@endsection
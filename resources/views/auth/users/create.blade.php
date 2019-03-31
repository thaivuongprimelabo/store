@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			@include('auth.common.create_form')
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
    			maxlength: {{  Common::NAME_MAXLENGTH }},
    		},
    		email: {
				required: true,
				email: true,
    		},
    		password: {
				required: true,
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
    		},
    		conf_password: {
    			required: true,
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
				equalTo: '#password'
    		},
    		role_id: {
				required: true
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		email : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.email') }}",
    			email: "{{ Utils::getValidateMessage('validation.email') }}",
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
    		role_id: {
    			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.users.form.role_id.text') }}",
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });

    $('#save_user').click(function(e) {
        if($("#submit_form").valid()) {
        	var input = {
        	   	value: $('#email').val(),
    			col : 'email',
    			table: 4,
    			itemName : $('#email').attr('placeholder'),
    			url: '{{ route('check_exists') }}',
    			id_check: $('#id').val()
    		};
    
        	if(checkExist(input)) {
    			$('#submit_form').submit();
        	}
        }
    });

</script>
@endsection
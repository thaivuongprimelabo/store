@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'edit_title'])
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
    			maxlength: {{  Common::NAME_MAXLENGTH }},
    		},
    		email: {
				required: true,
				email: true,
    		},
    		password: {
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
    		},
    		conf_password: {
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
				equalTo: '#password'
    		},
    		role_id: {
				required: true
    		},
    		avatar: {
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ Common::AVATAR_MAX_SIZE }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		email : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.email') }}",
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
    		avatar: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.vendors.form.avatar.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.vendors.form.avatar.text',  Utils::formatMemory(Common::AVATAR_MAX_SIZE)) }}'
    		}
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
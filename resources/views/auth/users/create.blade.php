@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.users.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_users') }}">{{ trans('auth.sidebar.users') }}</a></li>
    <li class="active">{{ trans('auth.users.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="create_form" action="?" method="post" enctype="multipart/form-data">
			@include('auth.common.alert')
			@include('auth.common.create_form',['forms' => trans('auth.users.form')])
			<div class="box-footer">
              	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_users') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.send') }}</button>
            </div>
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    var validatorEventSetting = $("#create_form").validate({
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
				remote : {
					url : '{{ route('check_exists') }}',
					type : 'post',
					headers: {
				    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					data : {
						value : function() {
							return $('#email').val()
						},
						col: 'email',
						table: 4
					}
				}
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
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.users.form.email') }}'
    		},
    		password : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.password') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.password', Common::PASSWORD_MAXLENGTH) }}",
    		},
    		conf_password : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.users.form.conf_password') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.users.form.conf_password', Common::PASSWORD_MAXLENGTH) }}",
    			equalTo: "{{ Utils::getValidateMessage('validation.confirmed', 'auth.users.form.conf_password', 'auth.users.form.password') }}"
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

    $('#avatar').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $(this);
    	var maxSize = '{{ Common::AVATAR_MAX_SIZE }}';
    	var width = '{{ Common::AVATAR_WIDTH }}';
    	var height = '{{ Common::AVATAR_HEIGHT }}';
    	previewImage(element, maxSize, width, height );
    	
    });
</script>
@endsection
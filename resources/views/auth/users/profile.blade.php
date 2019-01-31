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
			@include('auth.common.alert')
            @include('auth.common.edit_form',['forms' => trans('auth.profile.form'), 'data' => Auth::user()])
			<div class="box-footer">
              	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_users') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
            </div>
            <!-- /.box -->
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
    		password: {
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
    		},
    		conf_password: {
				maxlength: {{  Common::PASSWORD_MAXLENGTH }},
				equalTo: '#password'
    		},
    		avatar: {
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ $config['avatar_maximum_upload'] }}'
    		}
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
    		avatar: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.vendors.form.avatar.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.vendors.form.avatar.text',  Utils::formatMemory($config['avatar_maximum_upload'])) }}'
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
    	var maxSize = '{{ $config['avatar_maximum_upload'] }}';
    	var demension = '{{ $config['avatar_image_size'] }}';
    	previewImage(element, maxSize, demension);
    	
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.vendors.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_vendors') }}">{{ trans('auth.sidebar.products.vendors') }}</a></li>
    <li class="active">{{ trans('auth.vendors.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="0" />
			@include('auth.common.alert')
			@include('auth.common.create_form',['forms' => trans('auth.vendors.form')])
			@include('auth.common.button_footer',['back_url' => route('auth_vendors')])
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
    		description: {
				maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		logo: {
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ $config['logo_image_size'] }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.vendors.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.vendors.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		description : {
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.vendors.form.description.text', Common::DESC_MAXLENGTH) }}"
    		},
    		logo: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.vendors.form.logo.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.vendors.form.logo.text',  Utils::formatMemory($config['logo_image_size'])) }}'
    		}
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });

    $('#logo').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $(this);
    	var maxSize = '{{ $config['logo_maximum_upload'] }}';
    	var demension = '{{ $config['logo_image_size'] }}';
    	previewImage(element, maxSize, demension);
    });
</script>
@endsection
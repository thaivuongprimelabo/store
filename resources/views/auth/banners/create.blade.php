@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.banners.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_banners') }}">{{ trans('auth.sidebar.banners') }}</a></li>
    <li class="active">{{ trans('auth.banners.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				<input type="hidden" id="demension" value="{{ $config['banner_image_size'] }}" />
				<input type="hidden" id="upload_limit" value="{{ $config['banner_maximum_upload'] }}" />
    			@include('auth.common.alert')
    			@include('auth.common.create_form',['forms' => trans('auth.banners.form')])
                @include('auth.common.button_footer',['back_url' => route('auth_banners')])
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
    		link: {
        		url: true,
    			maxlength: {{  Common::LINK_MAXLENGTH }},
    		},
    		description: {
				maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		banner: {
    			required: true,
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ $config['banner_maximum_upload'] }}'
    		}
    	},
    	messages: {
    		link : {
    			url : "{{ Utils::getValidateMessage('validation.url', 'auth.banners.form.link') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.link', Common::LINK_MAXLENGTH) }}",
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.description.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.description.text', Common::DESC_MAXLENGTH) }}"
    		},
    		banner: {
    			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.banners.form.banner.text') }}",
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.banners.form.banner.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.banners.form.banner.text',  Utils::formatMemory($config['banner_maximum_upload'])) }}'
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
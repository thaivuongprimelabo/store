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
			@if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('auth.create_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="create_form" action="{{ route('auth_banners_create') }}" method="post" enctype="multipart/form-data">
                  @include('auth.common.create_form',['forms' => trans('auth.banners.form')])
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_banners') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
                  </div>
                </form>
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
    		link: {
    			maxlength: {{  Common::LINK_MAXLENGTH }},
    		},
    		description: {
				maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		banner: {
    			required: true,
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ Common::BANNER_MAX_SIZE }}'
    		}
    	},
    	messages: {
    		link : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.link') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.link', Common::LINK_MAXLENGTH) }}",
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.description.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.description.text', Common::DESC_MAXLENGTH) }}"
    		},
    		banner: {
    			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.banners.form.banner.text') }}",
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.banners.form.banner.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.banners.form.banner.text',  Utils::formatMemory(Common::BANNER_MAX_SIZE)) }}'
    		}
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });

    $('#banner').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $(this);
    	var maxSize = '{{ Common::BANNER_MAX_SIZE }}';
    	var width = '{{ Common::BANNER_WIDTH }}';
    	var height = '{{ Common::BANNER_HEIGHT }}';
    	previewImage(element, maxSize, width, height );
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.banners.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_banners') }}">{{ trans('auth.sidebar.banners') }}</a></li>
    <li class="active">{{ trans('auth.banners.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="edit_form" action="?" method="post" enctype="multipart/form-data">
    			@include('auth.common.alert')
    			@include('auth.common.edit_form',['forms' => trans('auth.banners.form'), 'data' => $banner])
    			<div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_banners') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
                </div>
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script src="{{ url('admin/js/jquery.validate.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var validatorEventSetting = $("#edit_form").validate({
    	ignore: ":hidden:not(input[type='file'])",
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: {
    		name: {
    			required: true,
    			maxlength: 255,
    			remote : {
					url : '{{ route('check_exists') }}',
					type : 'post',
					headers: {
				    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					data : {
						value : function() {
							return $('#name').val()
						},
						col: 'name',
						table: 0,
						id_check: $('#id').val()
					}
				}
    		},
    		description: {
    			required: true,
				maxlength: 300
    		},
    		banner: {
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ $config['banner_maximum_upload'] }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.name') }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.banners.form.name') }}'
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.description.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.description.text') }}"
    		},
    		banner: {
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

    $('#banner').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $(this);
    	var maxSize = '{{ $config['banner_maximum_upload'] }}';
    	var demension = '{{ $config['banner_image_size'] }}';
    	previewImage(element, maxSize, demension);
    });
</script>
@endsection
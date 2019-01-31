@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.products.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_products') }}">{{ trans('auth.sidebar.products') }}</a></li>
    <li class="active">{{ trans('auth.products.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@include('auth.common.alert')
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('auth.create_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="create_form" action="{{ route('auth_products_create') }}" method="post" enctype="multipart/form-data">
                  @include('auth.common.create_form',['forms' => trans('auth.products.form'), 'multiple' => true])
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_products') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" id="save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
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
		ignore: ":hidden:not(textarea, input[type='file'])",
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
        	jelm.parent().find('span.help-block').html('');
    	},
    	rules: {
    		name: {
    			required: true,
    			maxlength: {{  Common::NAME_MAXLENGTH }},
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
    					table: 2
    				}
    			}
    		},
    		price: {
        		required: true,
				maxlength: {{  Common::PRICE_MAXLENGTH }},
    		},
    		category_id: {
				required: true,
    		},
    		vendor_id: {
				required: true
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.name', Common::NAME_MAXLENGTH) }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.products.form.name') }}'
    		},
    		price: {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.price') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.price', Common::PRICE_MAXLENGTH) }}",
    		},
    		category_id: {
    			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.products.form.category_id.text') }}",
    		},
    		vendor_id: {
    			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.products.form.vendor_id.text') }}",
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
      	},
    });

    $('#save').click(function(e) {
    	$('#error_list').html('');
    	var error_msg = checkSizeMultiFile($('.upload_image_product'), '{{ Common::IMAGE_MAX_SIZE }}', '{{ trans('validation.size.file_multi') }}');
    	error_msg += checkExtMultiFile($('.upload_image_product'), '{{ Common::IMAGE_EXT }}', '{{ trans('validation.image_multi') }}');
    	
    	if(error_msg !== '') {
    		$('#error_list').parent().addClass('has-error');
			$('#error_list').append(error_msg);
			return false;
    	}
    	return true;
    });


    $(document).on('change', '.upload_image_product', function(e) {
    	$(this).parent().parent().parent().removeClass('has-error');
    	$(this).parent().parent().parent().find('span.help-block').html('');
    	var input = $(this);
    	var maxSize = '{{ $config['image_maximum_upload'] }}';
    	var demension = '{{ $config['image_image_size'] }}';
    	previewImage(input, maxSize, demension);
        
    });
</script>
@endsection
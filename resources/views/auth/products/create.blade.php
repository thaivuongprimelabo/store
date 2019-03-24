@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.products.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_products') }}">{{ trans('auth.sidebar.products.products') }}</a></li>
    <li class="active">{{ trans('auth.products.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="2" />
			@include('auth.common.alert')
			@include('auth.common.create_form',['forms' => trans('auth.products.form'), 'upload_product' => true])
			@include('auth.common.button_footer',['back_url' => route('auth_products')])
            </form>
		</div>
	</div>
</section>
@endsection
@include('auth.products.upload_modal')
@section('script')
<script type="text/javascript">
    
	var validatorEventSetting = $("#submit_form").validate({
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
    		},
    		price: {
        		required: true,
				maxlength: {{  Common::PRICE_MAXLENGTH }},
    		},
//     		category_id: {
// 				required: true,
//     		},
//     		vendor_id: {
// 				required: true
//     		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		price: {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.price') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.price', Common::PRICE_MAXLENGTH) }}",
    		},
//     		category_id: {
//     			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.products.form.category_id.text') }}",
//     		},
//     		vendor_id: {
//     			required : "{{ Utils::getValidateMessage('validation.required_select', 'auth.products.form.vendor_id.text') }}",
//     		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
      	},
    });


    $('#save').click(function(e) {
    	$('#error_list').html('');
    });

    $(document).on('click', '.remove', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			$(this).parent().remove();
			return true;
		}
		return false;
	});

    $(document).on('click', '.add_image', function(e) {

		var index = Number($('#upload_index').val()) + 1;
		var html = '<div id="img_' + index + '" class="image_product" style="display: none;">';
		html += '<a href="javascript:void(0)" class="upload_image" style="width: 150px; height: 150px">';
		html += '<i class="fa fa-upload" aria-hidden="true"></i><br/>{{ trans('auth.button.upload_image') }}';
		html += '</a>';
		html += '<input type="file" name="image_upload[]" class="upload_image_product" style="display: none" />';
		html += '<input type="hidden" name="image_upload_url[]" class="upload_image_product_url" />';
		html += '<input type="hidden" name="image_ids[]" class="upload_image_id" value="" />';
		html += '</div>';

		$('#select_image').attr('data-id', index);
		$('#preview_list').prepend(html);
		$('#uploadModal').modal();
		$('#upload_index').val(index);
	});

    $(document).on('click', '#upload_by_computer', function(e) {
		var index = $('#select_image').attr('data-id');
		$('#img_' + index).find('.upload_image_product').click();
    });

    $(document).on('blur', '#upload_by_url', function(e) {
    	$('#preview').attr('src', $(this).val());
    });

    $(document).on('click', '#select_image', function(e) {
    	var index = $('#select_image').attr('data-id');
    	var img = $('#preview').attr('src');
    	var demension = '{{ $config['image_image_size'] }}';
    	var arr = demension.split('x');
    	$('#img_' + index).attr('style','display:inline-block');
    	$('#img_' + index).find('a').html('<img src="' + img + '" style="width:' + arr[0] + 'px; height:' + arr[1] + 'px" />');
    	$('#img_' + index).find('.upload_image_id').val(index);
    	if(img.indexOf('http') !== -1 || img.indexOf('https') !== -1) {
    		$('#img_' + index).find('.upload_image_product_url').val(img);
    	}
		$('#uploadModal').modal('toggle');
	});

    $('#uploadModal').on('show.bs.modal', function (event) {
		$('#preview').attr('src','');
		$('#upload_by_url').val('');
		$('#error_list').html('');
    });

    $('#uploadModal').on('hide.bs.modal', function (event) {
		$('#preview').attr('src','');
		$('#upload_by_url').val('');
		$('.upload_image_product').val('');
    });
    
    $(document).on('change', '.upload_image_product', function(e) {
    	$(this).parent().parent().parent().removeClass('has-error');
    	$(this).parent().parent().parent().find('span.help-block').html('');
    	var input = $(this);
    	var maxSize = '{{ $config['image_maximum_upload'] }}';
    	var demension = '{{ $config['image_image_size'] }}';
    	var rules = ['{{ Common::IMAGE_EXT }}', maxSize];
    	if(checkFileUpload(input, rules, '{{ trans('validation.size.file_multi') }}', '#error_list')) {
    		previewImageProduct(input, maxSize, demension, '#preview');
    	}
    });
</script>
@endsection
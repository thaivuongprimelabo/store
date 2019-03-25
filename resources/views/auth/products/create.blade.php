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
			<input type="hidden" id="demension" value="{{ $config['image_image_size'] }}" />
			<input type="hidden" id="upload_limit" value="{{ $config['image_maximum_upload'] }}" />
			@include('auth.common.alert')
			@include('auth.common.create_form',['forms' => trans('auth.products.form'), 'upload_product' => true])
			@include('auth.common.button_footer',['back_url' => route('auth_products')])
            </form>
		</div>
	</div>
</section>
@endsection
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
		html += '<input type="hidden" name="image_ids[]" class="upload_image_id" value="9999" />';
		html += '</div>';

		$('#select_image').attr('data-id', index);
		$('#preview_list').prepend(html);
		$('#uploadModal').modal();
		$('#upload_index').val(index);
	});

</script>
@endsection
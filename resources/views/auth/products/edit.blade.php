@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.products.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_products') }}">{{ trans('auth.sidebar.products') }}</a></li>
    <li class="active">{{ trans('auth.products.edit_title') }}</li>
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
                <form role="form" id="edit_form" action="{{ route('auth_products_edit',['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                  	<input type="hidden" name="id" id="id" value="{{ $product->id }}" />
                    <div class="form-group @if ($errors->has('name')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.products.form.name') }}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="{{ trans('auth.products.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                      <span class="help-block">@if ($errors->has('name')){{ $errors->first('name') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('price')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.products.form.price') }}</label>
                      <input type="text" class="form-control" name="price" id="price" value="{{ old('price',  $product->price) }}" placeholder="{{ trans('auth.products.form.price') }}" maxlength="{{ Common::PRICE_MAXLENGTH }}" />
                      <span class="help-block">@if ($errors->has('price')){{ $errors->first('price') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('category_id')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.products.form.category_id') }}</label>
                      <select name="category_id" id="category_id" class="form-control">
                      	<option value="">{{ trans('auth.select_empty_text') }}</option>
                      	{!! Utils::createSelectList(Common::CATEGORIES,  $product->category_id) !!}
                      </select>
                      <span class="help-block">@if ($errors->has('category_id')){{ $errors->first('category_id') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('vendor_id')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.products.form.vendor_id') }}</label>
                      <select name="vendor_id" id="vendor_id" class="form-control">
                      	<option value="">{{ trans('auth.select_empty_text') }}</option>
                      	{!! Utils::createSelectList(Common::VENDORS,  $product->vendor_id) !!}
                      </select>
                      <span class="help-block">@if ($errors->has('vendor_id')){{ $errors->first('vendor_id') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.products.form.description') }}</label>
                      <textarea class="wysihtml_editor" name="description" id="description" placeholder="Place some text here"
                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description',  $product->description) }}</textarea>
                      <span class="help-block">@if ($errors->has('description')){{ $errors->first('description') }}@endif</span>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status', $product->status)) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.active') }}
                      </label>
                    </div>
                    @include('auth.common.upload_product',[
                    	'text' => trans('auth.products.form.image'),
                    	'text_small' => trans('auth.products.form.image_text'),
                    	'errors' => $errors,
                    	'name' => 'image',
                    	'size' => Utils::formatMemory(Common::IMAGE_MAX_SIZE),
                    	'width' => Common::IMAGE_WIDTH,
                    	'height' => Common::IMAGE_HEIGHT,
                    	'image_using' => $product->getAllImage($product->id),
                    ])
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_products') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
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

var validatorEventSetting = $("#edit_form").validate({
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
					table: 2,
					id_check: $('#id').val()
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
		description: {
			required: true,
		}
	},
	messages: {
		name : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.name') }}",
			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.name', Common::NAME_MAXLENGTH) }}",
			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.products.form.name') }}'
		},
		price: {
			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.price', Common::PRICE_MAXLENGTH) }}",
		},
		category_id: {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.category_id') }}",
		},
		vendor_id: {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.vendor_id') }}",
		},
		description : {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.description') }}",
		}
	},
	errorPlacement: function(error, element) {
		customErrorValidate(error, element);
  	},
  	submitHanlder: function(form) {
	    form.submit();
	}
});

$('#submit').click(function(e) {
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
	var maxSize = '{{ Common::PRODUCT_MAX_SIZE }}';
	var width = '{{ Common::PRODUCT_WIDTH }}';
	var height = '{{ Common::PRODUCT_HEIGHT }}';
    previewImage(input, maxSize, width, height);
    
});
</script>
@endsection
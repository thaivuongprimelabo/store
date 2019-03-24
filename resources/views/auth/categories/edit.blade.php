@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.categories.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_categories') }}">{{ trans('auth.sidebar.categories') }}</a></li>
    <li class="active">{{ trans('auth.categories.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="0" />
			@include('auth.common.alert')
			@include('auth.common.edit_form',['data' => $category, 'forms' => trans('auth.categories.form')])
			@include('auth.common.button_footer',['back_url' => route('auth_categories')])
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    var validatorEventSetting = $("#submit_form").validate({
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
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.categories.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.categories.form.name', Common::NAME_MAXLENGTH) }}",
    		},
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
    	var element = $('input[name="logo"]')[0];
    	
    	if(checkFileSize(element, '{{ Common::LOGO_MAX_SIZE }}')) {
    		var reader = new FileReader();
            reader.onload = function (event) {
                $('#logo_preview').attr('src', event.target.result);
            }
            reader.readAsDataURL($('input[name="logo"]')[0].files[0]);
    	}
    	
    });
</script>
@endsection
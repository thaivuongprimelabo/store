@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.posts.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_posts') }}">{{ trans('auth.sidebar.posts') }}</a></li>
    <li class="active">{{ trans('auth.posts.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="3" />
			<input type="hidden" id="demension" value="{{ $config['photo_image_size'] }}" />
			<input type="hidden" id="upload_limit" value="{{ $config['photo_maximum_upload'] }}" />
			@include('auth.common.create_form',['forms' => trans('auth.posts.form')])
			@include('auth.common.button_footer',['back_url' => route('auth_posts')])
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    //Date picker
    $('#published_at').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
    });
    
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });
    
	var validatorEventSetting = $("#submit_form").validate({
		ignore: ":hidden:not(textarea, input[type='file'])",
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
    			required: true,
    			maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		content: {
    			required: function(textarea) {
			       CKEDITOR.instances[textarea.id].updateElement();
			       var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
			       return editorcontent.length === 0;
				}
    		},
    		photo: {
    			extension: '{{ Common::IMAGE_EXT }}',
    			filesize: '{{ $config['photo_maximum_upload'] }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.name.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.name.text', Common::NAME_MAXLENGTH) }}",
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.description.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.description.text', Common::DESC_MAXLENGTH) }}"
    		},
    		content : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.content.text') }}",
    		},
    		photo: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.posts.form.photo.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.posts.form.photo.text',  Utils::formatMemory($config['photo_maximum_upload'])) }}'
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
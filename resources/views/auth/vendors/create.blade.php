@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="0" />
			@include('auth.common.create_form')
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
				filesize: '{{ $config[$name . '_image_size'] }}'
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
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.vendors.form.logo.text',  Utils::formatMemory($config[$name . '_image_size'])) }}'
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
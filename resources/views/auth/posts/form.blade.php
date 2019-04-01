@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'edit_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="3" />
			@if(isset($data) && $data->id)
			@include('auth.common.edit_form')
			@else
			@include('auth.common.create_form')
			@endif
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
    			required: true
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.description.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.description.text', Common::DESC_MAXLENGTH) }}"
    		},
    		content : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.content.text') }}",
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
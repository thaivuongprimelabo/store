@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="2" />
			@include('auth.common.create_form',['tab' => true])
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


</script>
@endsection
@extends('layouts.app')

@section('content')
@include('auth.common.content_header')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
    			<input type="hidden" id="table" value="1" />
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
	var validateObject = {!! Utils::generateValidation($name, $rules) !!}
    var validatorEventSetting = $("#submit_form").validate({
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: validateObject.rules,
    	messages: validateObject.messages,
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });

</script>
@endsection
@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'edit_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="upload_limit" value="{{ $config['attachment_maximum_upload'] }}" />
			@include('auth.common.edit_form')
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
var validatorEventSetting = $("#submit_form").validate({
	ignore: ":hidden:not(textarea)",
	onfocusout: false,
	success: function(label, element) {
    	var jelm = $(element);
    	jelm.parent().removeClass('has-error');
	},
	rules: {
		reply_content: {
			required: function(textarea) {
		       CKEDITOR.instances[textarea.id].updateElement();
		       var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
		       return editorcontent.length === 0;
			}
		},
		attachment: {
			extension: '{{ Common::FILE_EXT }}',
			filesize: '{{ $config['attachment_maximum_upload'] }}'
		}
	},
	messages: {
		reply_content: {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.contacts.form.reply.reply_content.text') }}",
		},
		attachment: {
			extension : '{{ Utils::getValidateMessage('validation.file', 'auth.contacts.form.reply.attachment.text') }}',
			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.contacts.form.reply.attachment.text',  Utils::formatMemory($config['attachment_maximum_upload'])) }}'
		}
	},
	errorPlacement: function(error, element) {
		customErrorValidate(error, element);
  	},
	submitHanlder: function(form) {
	    form.submit();
	}
});

$(document).on('change', '.upload_image_product', function(e) {
	$(this).parent().parent().parent().removeClass('has-error');
	$(this).parent().parent().parent().find('span.help-block').html('');
	var input = $(this);
	var maxSize = '{{ $config['attachment_maximum_upload'] }}';
	var demension = '100x100';
	previewImage(input, maxSize, demension);
    
});
</script>
@endsection
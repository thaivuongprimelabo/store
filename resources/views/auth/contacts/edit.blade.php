@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.contacts.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_contacts') }}">{{ trans('auth.sidebar.contacts') }}</a></li>
    <li class="active">{{ $contact->name }} - {{ $contact->email }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="upload_limit" value="{{ $config['attachment_maximum_upload'] }}" />
			@include('auth.common.alert')
			@php
              	$forms = trans('auth.contacts.form');
            @endphp
            @foreach($forms as $key=>$form)
            @include('auth.common.edit_form', ['forms' => $form, 'data' => $contact])
            @endforeach
            @include('auth.common.button_footer',['back_url' => route('auth_contacts')])
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
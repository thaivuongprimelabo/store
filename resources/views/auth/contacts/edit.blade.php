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
			@if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">To: {{ $contact->name }} - {{ $contact->email }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="edit_form" action="{{ route('auth_contacts_edit', ['id' => $contact->id]) }}" method="post" enctype="multipart/form-data">
                  @include('auth.common.edit_form',['forms' => trans('auth.contacts.form'), 'data' => $contact])
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_contacts') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('auth.button.send') }}</button>
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
	ignore: ":hidden:not(textarea)",
	onfocusout: false,
	success: function(label, element) {
    	var jelm = $(element);
    	jelm.parent().removeClass('has-error');
	},
	rules: {
		reply_content: {
			required: true
		},
		attachment: {
			extension: '{{ Common::FILE_EXT }}',
			filesize: '{{ Common::ATTACHMENT_MAX_SIZE }}'
		}
	},
	messages: {
		reply_content: {
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.contacts.form.reply.text') }}",
		},
		attachment: {
			extension : '{{ Utils::getValidateMessage('validation.file', 'auth.contacts.form.attachment.text') }}',
			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.contacts.form.attachment.text',  Utils::formatMemory(Common::ATTACHMENT_MAX_SIZE)) }}'
		}
	},
	errorPlacement: function(error, element) {
		customErrorValidate(error, element);
  	},
	submitHanlder: function(form) {
	    form.submit();
	}
});

$('#attachment').change(function(e) {
	$(this).parent().removeClass('has-error');
	var element = $('input[name="logo"]')[0];
});
</script>
@endsection
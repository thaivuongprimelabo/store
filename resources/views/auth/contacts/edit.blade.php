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
                  {{ csrf_field() }}
                  <input type="hidden" name="id" id="id" value="{{ $contact->id }}" />
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ trans('auth.contacts.form.name') }}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $contact->name) }}" placeholder="{{ trans('auth.contacts.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}" disabled="disabled">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ trans('auth.contacts.form.email') }}</label>
                      <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $contact->email) }}" placeholder="{{ trans('auth.contacts.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}" disabled="disabled">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ trans('auth.contacts.form.phone') }}</label>
                      <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" placeholder="{{ trans('auth.contacts.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}" disabled="disabled">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ trans('auth.contacts.form.content') }}</label>
                      <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" placeholder="{{ trans('auth.contacts.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}" disabled="disabled">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ trans('auth.contacts.form.content') }}</label>
                      <textarea class="form-control" rows="6" name="description" placeholder="{{ trans('auth.contacts.form.content') }}" maxlength="{{ Common::DESC_MAXLENGTH }}"  disabled="disabled">{{ old('content', $contact->content) }}</textarea>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status', $contact->status)) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.replied') }}
                      </label>
                    </div>
                    <div class="form-group @if ($errors->has('reply_content')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.contacts.form.reply') }}</label>
                      <textarea class="wysihtml_editor" name="reply_content" id="reply_content" placeholder="Place some text here"
                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      <span class="help-block">@if ($errors->has('reply_content')){{ $errors->first('reply_content') }}@endif</span>
                    </div>
                    @include('auth.common.upload',[
                    	'text' => trans('auth.contacts.form.attachment'),
                    	'text_small' => trans('auth.contacts.form.attachment_text'),
                    	'errors' => $errors,
                    	'name' => 'attachment',
                    	'size' => Utils::formatMemory(Common::ATTACHMENT_MAX_SIZE)
                    ])
                  </div>
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
			required : "{{ Utils::getValidateMessage('validation.required', 'auth.contacts.form.reply') }}",
		},
		attachment: {
			extension : '{{ Utils::getValidateMessage('validation.file', 'auth.contacts.form.attachment') }}',
			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.contacts.form.attachment',  Utils::formatMemory(Common::ATTACHMENT_MAX_SIZE)) }}'
		}
	},
	errorPlacement: function(error, element) {
		element.parent().addClass('has-error');
		element.parent().find('span.help-block').html(error[0].innerHTML);
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
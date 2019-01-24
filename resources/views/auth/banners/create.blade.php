@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.banners.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_banners') }}">{{ trans('auth.sidebar.banners') }}</a></li>
    <li class="active">{{ trans('auth.banners.create_title') }}</li>
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
                  <h3 class="box-title">{{ trans('auth.create_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="create_form" action="{{ route('auth_banners_create') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group @if ($errors->has('name')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.banners.form.link') }}</label>
                      <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}" placeholder="{{ trans('auth.banners.form.link') }}" maxlength="{{ Common::LINK_MAXLENGTH }}">
                      <span class="help-block">@if ($errors->has('link')){{ $errors->first('link') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.banners.form.description') }}</label>
                      <textarea class="form-control" rows="6" name="description" placeholder="{{ trans('auth.banners.form.description') }}" maxlength="{{ Common::DESC_MAXLENGTH }}">{{ old('description') }}</textarea>
                      <span class="help-block">@if ($errors->has('description')){{ $errors->first('description') }}@endif</span>
                    </div>
                    @include('auth.common.upload',[
                    	'text' => trans('auth.banners.form.banner'),
                    	'text_small' => trans('auth.banners.form.banner_text'),
                    	'errors' => $errors,
                    	'name' => 'banner',
                    	'size' => Utils::formatMemory(Common::BANNER_MAX_SIZE)
                    ])
                    <div class="form-group">
                      <label for="exampleInputFile">Hình hiện tại</label>
                      <img class="img img-responsive" id="banner_preview" alt="" src="" width="150" height="120" />
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status')) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.active') }}
                      </label>
                    </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_banners') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
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
    var validatorEventSetting = $("#create_form").validate({
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: {
    		link: {
    			maxlength: {{  Common::LINK_MAXLENGTH }},
    		},
    		description: {
				maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		banner: {
    			required: true,
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ Common::BANNER_MAX_SIZE }}'
    		}
    	},
    	messages: {
    		link : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.link') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.link', Common::LINK_MAXLENGTH) }}",
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.description') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.banners.form.description', Common::DESC_MAXLENGTH) }}"
    		},
    		banner: {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.banners.form.banner') }}",
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.banners.form.banner') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.banners.form.banner',  Utils::formatMemory(Common::BANNER_MAX_SIZE)) }}'
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

    $('#banner').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $('input[name="banner"]')[0];
    	
    	if(checkFileSize(element, '{{ Common::BANNER_MAX_SIZE }}')) {
    		var reader = new FileReader();
            reader.onload = function (event) {
                $('#banner_preview').attr('src', event.target.result);
            }
            reader.readAsDataURL($('input[name="banner"]')[0].files[0]);
    	}
    	
    });
</script>
@endsection
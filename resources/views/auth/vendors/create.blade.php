@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.vendors.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_vendors') }}">{{ trans('auth.sidebar.vendors') }}</a></li>
    <li class="active">{{ trans('auth.vendors.create_title') }}</li>
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
                <form role="form" id="create_form" action="{{ route('auth_vendors_create') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group @if ($errors->has('name')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.vendors.form.name') }}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="{{ trans('auth.vendors.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                      <span class="help-block">@if ($errors->has('name')){{ $errors->first('name') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.vendors.form.description') }}</label>
                      <textarea class="form-control" rows="6" name="description" placeholder="{{ trans('auth.vendors.form.description') }}" maxlength="{{ Common::DESC_MAXLENGTH }}">{{ old('description') }}</textarea>
                      <span class="help-block">@if ($errors->has('description')){{ $errors->first('description') }}@endif</span>
                    </div>
                    @include('auth.common.upload',[
                    	'text' => trans('auth.vendors.form.logo'),
                    	'text_small' => trans('auth.vendors.form.logo_text'),
                    	'errors' => $errors,
                    	'name' => 'logo',
                    	'size' => Utils::formatMemory(Common::LOGO_MAX_SIZE),
                    	'width' => Common::LOGO_WIDTH,
                    	'height' => Common::LOGO_HEIGHT,
                    	'image_using' => []
                    ])
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status')) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.active') }}
                      </label>
                    </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_vendors') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
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
    		name: {
    			required: true,
    			maxlength: {{  Common::NAME_MAXLENGTH }},
    			remote : {
					url : '{{ route('check_exists') }}',
					type : 'post',
					headers: {
				    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					data : {
						value : function() {
							return $('#name').val()
						},
						col: 'name',
						table: 0
					}
				}
    		},
    		description: {
    			required: true,
				maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		logo: {
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ Common::LOGO_MAX_SIZE }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.vendors.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.vendors.form.name', Common::NAME_MAXLENGTH) }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.vendors.form.name') }}'
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.vendors.form.description') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.vendors.form.description', Common::DESC_MAXLENGTH) }}"
    		},
    		logo: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.vendors.form.logo') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.vendors.form.logo',  Utils::formatMemory(Common::LOGO_MAX_SIZE)) }}'
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

    $('#logo').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $('input[name="logo"]')[0];
    	var maxSize = '{{ Common::LOGO_MAX_SIZE }}';
    	var width = '{{ Common::LOGO_WIDTH }}';
    	var height = '{{ Common::LOGO_HEIGHT }}';
    	previewImage(element, maxSize, width, height );
    });
</script>
@endsection
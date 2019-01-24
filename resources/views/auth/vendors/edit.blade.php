@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.vendors.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_vendors') }}">{{ trans('auth.sidebar.vendors') }}</a></li>
    <li class="active">{{ trans('auth.vendors.edit_title') }}</li>
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
                <form role="form" id="edit_form" action="{{ route('auth_vendors_edit', ['id' => $vendor->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                  	<input type="hidden" name="id" id="id" value="{{ $vendor->id }}" />
                    <div class="form-group @if ($errors->has('name')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.vendors.form.name') }}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $vendor->name) }}" placeholder="{{ trans('auth.vendors.form.name') }}">
                      <span class="help-block">@if ($errors->has('name')){{ $errors->first('name') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.vendors.form.description') }}</label>
                      <textarea class="form-control" rows="6" name="description" placeholder="{{ trans('auth.vendors.form.description') }}">{{ old('description', $vendor->description) }}</textarea>
                      <span class="help-block">@if ($errors->has('description')){{ $errors->first('description') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('logo')){{'has-error'}} @endif">
                      <label for="exampleInputFile">{{ trans('auth.vendors.form.logo') }}</label>
                      <input type="file" name="logo" id="logo">
                      <p class="help-block">{{ trans('auth.vendors.form.logo_text') }}</p>
                      <span class="help-block">@if ($errors->has('logo')){{ $errors->first('logo') }}@endif</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Hình hiện tại</label>
                      <img class="img img-responsive" alt="" src="{{ Utils::getImageLink($vendor->logo) }}" width="150" height="120" />
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status', $vendor->status)) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.active') }}
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
<script src="{{ url('admin/js/jquery.validate.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var validatorEventSetting = $("#edit_form").validate({
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
    	},
    	rules: {
    		name: {
    			required: true,
    			maxlength: 255,
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
						table: 0,
						id_check: $('#id').val()
					}
				}
    		},
    		description: {
    			required: true,
				maxlength: 300
    		},
    		logo: {
				extension: '{{ Common::IMAGE_EXT }}',
				filesize: '{{ Common::LOGO_MAX_SIZE }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.vendors.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.vendors.form.name') }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.vendors.form.name') }}'
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.vendors.form.description') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.vendors.form.description') }}"
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
    });
</script>
@endsection
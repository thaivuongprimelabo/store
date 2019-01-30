@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.categories.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_categories') }}">{{ trans('auth.sidebar.categories') }}</a></li>
    <li class="active">{{ trans('auth.categories.create_title') }}</li>
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
                <form role="form" id="create_form" action="{{ route('auth_categories_create') }}" method="post" enctype="multipart/form-data">
                  @include('auth.common.create_form',['forms' => trans('auth.categories.form')])
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_categories') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
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
						table: 1
					}
				}
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.categories.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.categories.form.name', Common::NAME_MAXLENGTH) }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.categories.form.name') }}'
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });

    $('#logo').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $('input[name="logo"]')[0];
    	
    	if(checkFileSize(element, '{{ Common::LOGO_MAX_SIZE }}')) {
    		var reader = new FileReader();
            reader.onload = function (event) {
                $('#logo_preview').attr('src', event.target.result);
            }
            reader.readAsDataURL($('input[name="logo"]')[0].files[0]);
    	}
    	
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.posts.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_posts') }}">{{ trans('auth.sidebar.posts') }}</a></li>
    <li class="active">{{ trans('auth.posts.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@include('auth.common.alert')
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('auth.edit_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="create_form" action="{{ route('auth_posts_edit', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  @include('auth.common.edit_form',['forms' => trans('auth.posts.form'), 'data' => $post])
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_posts') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
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
    //Date picker
    $('#published_at').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
    });
    
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });
    
	var validatorEventSetting = $("#create_form").validate({
		ignore: ":hidden:not(textarea, input[type='file'])",
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
    					table: 3,
    					id_check: $('#id').val()
    				}
    			}
    		},
    		description: {
    			required: true,
    			maxlength: {{  Common::DESC_MAXLENGTH }}
    		},
    		content: {
    			required: true
    		},
    		photo: {
        		required: true,
    			extension: '{{ Common::IMAGE_EXT }}',
    			filesize: '{{ $photo_maximum_upload }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.name', Common::NAME_MAXLENGTH) }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.posts.form.name') }}'
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.description.text') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.description.text', Common::DESC_MAXLENGTH) }}"
    		},
    		content : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.content.text') }}",
    		},
    		photo: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.posts.form.photo.text') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.posts.form.photo.text',  Utils::formatMemory($photo_maximum_upload)) }}'
    		}
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
      	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });

    $('#photo').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $(this);
    	var maxSize = '{{ $config['photo_maximum_upload'] }}';
    	var demension = '{{ $config['photo_image_size'] }}';
    	previewImage(element, maxSize, demension );
    });
</script>
@endsection
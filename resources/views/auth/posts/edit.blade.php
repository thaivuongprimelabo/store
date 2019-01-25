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
			@if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('auth.edit_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="create_form" action="{{ route('auth_posts_edit', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group @if ($errors->has('name')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.posts.form.name') }}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $post->name) }}" placeholder="{{ trans('auth.posts.form.name') }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                      <span class="help-block">@if ($errors->has('name')){{ $errors->first('name') }}@endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.vendors.form.description') }}</label>
                      <textarea class="form-control" rows="3" name="description" placeholder="{{ trans('auth.vendors.form.description') }}" maxlength="{{ Common::DESC_MAXLENGTH }}">{{ old('description', $post->description) }}</textarea>
                      <span class="help-block">@if ($errors->has('description')){{ $errors->first('description') }}@endif</span>
                    </div>
                    @include('auth.common.upload',[
                    	'text' => trans('auth.posts.form.photo'),
                    	'text_small' => trans('auth.posts.form.photo_text'),
                    	'errors' => $errors,
                    	'name' => 'photo',
                    	'size' => Utils::formatMemory(Common::PHOTO_MAX_SIZE),
                    	'width' => Common::PHOTO_WIDTH,
                    	'height' => Common::PHOTO_HEIGHT,
                    	'image_using' => Utils::getImageLink($post->photo),
                    ])
                    <div class="form-group @if ($errors->has('content')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.posts.form.content') }}</label>
                      <textarea class="wysihtml_editor" name="content" id="content" placeholder="Place some text here"
                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('content', $post->content) }}</textarea>
                      <span class="help-block">@if ($errors->has('content')){{ $errors->first('content') }}@endif</span>
                    </div>
                    <div class="form-group">
                      	<label for="exampleInputPassword1">{{ trans('auth.posts.form.published_at') }}</label>
                      	<input type="text" class="form-control" name="published_at" id="published_at" value="{{ old('published_at', date('d-m-Y', strtotime($post->published_at))) }}" placeholder="{{ trans('auth.posts.form.published_at') }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <label>{{ trans('auth.posts.form.published_time_at') }}</label>
                          <input type="text" name="published_time_at" id="published_time_at" value="{{ old('published_at', date('h:i A', strtotime($post->published_at))) }}" class="form-control timepicker">
                        </div>
                      </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status', $post->status)) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.published') }}
                      </label>
                    </div>
                  </div>
                  <!-- /.box-body -->
    
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
		ignore: ":hidden:not(textarea)",
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
    			filesize: '{{ Common::PHOTO_MAX_SIZE }}'
    		}
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.name', Common::NAME_MAXLENGTH) }}",
    			remote: '{{ Utils::getValidateMessage('validation.unique', 'auth.posts.form.name') }}'
    		},
    		description : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.description') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.posts.form.description', Common::DESC_MAXLENGTH) }}"
    		},
    		content : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.posts.form.content') }}",
    		},
    		photo: {
    			extension : '{{ Utils::getValidateMessage('validation.image', 'auth.posts.form.photo') }}',
    			filesize: '{{ Utils::getValidateMessage('validation.size.file', 'auth.posts.form.photo',  Utils::formatMemory(Common::PHOTO_MAX_SIZE)) }}'
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

    $('#photo').change(function(e) {
    	$(this).parent().removeClass('has-error');
    	var element = $('input[name="photo"]')[0];
    	
    	if(checkFileSize(element, '{{ Common::PHOTO_MAX_SIZE }}')) {
    		var reader = new FileReader();
            reader.onload = function (event) {
                $('#preview').attr('src', event.target.result);
            }
            reader.readAsDataURL($('input[name="photo"]')[0].files[0]);
    	}
    	
    });
</script>
@endsection
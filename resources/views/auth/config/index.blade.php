@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.config.title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_config') }}">{{ trans('auth.sidebar.config') }}</a></li>
    <li class="active">{{ trans('auth.config.title') }}</li>
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
                <form role="form" id="create_form" action="{{ route('auth_config') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    @php
                    	$forms = trans('auth.config.form');
                    @endphp
                    @foreach($forms as $key=>$value)
                    @if($key != 'status' && $key != 'off' && $key != 'web_logo')
                    <div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ $value }}</label>
                      <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $config->$key) }}" placeholder="{{ $value }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                      <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                    </div>
                    @elseif($key == 'web_logo')
                    @include('auth.common.upload',[
                    	'text' => trans('auth.config.form.web_logo'),
                    	'text_small' => trans('auth.config.weblogo_text'),
                    	'errors' => $errors,
                    	'name' => 'web_logo',
                    	'size' => Utils::formatMemory(Common::WEB_LOGO_MAX_SIZE),
                    	'width' => Common::WEB_LOGO_WIDTH,
                    	'height' => Common::WEB_LOGO_HEIGHT,
                    	'image_using' => Utils::getImageLink($config->$key)
                    ])
                    @else
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="{{ $key }}" value="1" @if(old($key, $config->$key)) {{ 'checked="checked"' }} @endif> {{ $value }}
                      </label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
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
$('#web_logo').change(function(e) {
	$(this).parent().removeClass('has-error');
	var element = $('input[name="web_logo"]')[0];
	
	if(checkFileSize(element, '{{ Common::WEB_LOGO_MAX_SIZE }}')) {
		var reader = new FileReader();
        reader.onload = function (event) {
            $('#preview').attr('src', event.target.result);
        }
        reader.readAsDataURL($('input[name="web_logo"]')[0].files[0]);
	}
	
});
</script>
@endsection
@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.config.title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_config_edit') }}">{{ trans('auth.sidebar.config') }}</a></li>
    <li class="active">{{ trans('auth.config.title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="create_form" action="?" method="post" enctype="multipart/form-data">
    			@include('auth.common.alert')
    			@php
                  	$forms = trans('auth.config.form');
                @endphp
                @foreach($forms as $key=>$form)
                @include('auth.common.edit_form', ['forms' => $form, 'data' => $config_data])
                @endforeach
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
                </div>
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
$('#web_logo').change(function(e) {
	$(this).parent().removeClass('has-error');
	var element = $(this);
	var maxSize = '{{ $config['web_logo_maximum_upload'] }}';
	var demension = '{{ $config['web_logo_image_size'] }}';
	previewImage(element, maxSize, demension );
	
});
</script>
@endsection
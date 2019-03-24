@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.config.title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_config_edit') }}">{{ trans('auth.sidebar.config_edit') }}</a></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
    			@include('auth.common.alert')
    			@php
                  	$forms = trans('auth.config.form');
                  	$accept = [
                  		'web_info', 'payment_method', 'off'
                  	];
                @endphp
                @foreach($forms as $key=>$form)
                @if(Auth::user()->role_id != Common::SUPER_ADMIN)
                	@if(in_array($key, $accept))
                	@include('auth.common.edit_form', ['forms' => $form, 'data' => $config_data])
                	@endif
                @endif
                
                @if(Auth::user()->role_id == Common::SUPER_ADMIN)
                	@include('auth.common.edit_form', ['forms' => $form, 'data' => $config_data])
                @endif
                @endforeach
                <div class="box-footer">
                    <button type="submit" name="save" value="1" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
                    @if(Auth::user()->role_id == Common::SUPER_ADMIN)
                    <button type="submit" name="clear_data" value="1" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> {{ trans('auth.button.remove_all_data') }}</button>
                    <button type="submit" name="clear_config_cache" value="1" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> {{ trans('auth.button.clear_config_cache') }}</button>
                	@endif
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
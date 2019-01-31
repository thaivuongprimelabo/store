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
			@include('auth.common.alert')
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('auth.edit_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="create_form" action="{{ route('auth_config_edit') }}" method="post" enctype="multipart/form-data">
                  @include('auth.common.edit_form', ['forms' => trans('auth.config.form'), 'data' => $config])
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
	var element = $(this);
	var maxSize = '{{ Common::WEB_LOGO_MAX_SIZE }}';
	var width = '{{ Common::WEB_LOGO_WIDTH }}';
	var height = '{{ Common::WEB_LOGO_HEIGHT }}';
	previewImage(element, maxSize, width, height );
	
});
</script>
@endsection
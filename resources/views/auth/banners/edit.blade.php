@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.banners.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_banners') }}">{{ trans('auth.sidebar.banners') }}</a></li>
    <li class="active">{{ trans('auth.banners.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				<input type="hidden" id="demension" value="{{ $config['banner_image_size'] }}" />
				<input type="hidden" id="upload_limit" value="{{ $config['banner_maximum_upload'] }}" />
    			@include('auth.common.edit_form',['forms' => trans('auth.banners.form'), 'data' => $banner])
    			@include('auth.common.button_footer',['back_url' => route('auth_banners')])
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
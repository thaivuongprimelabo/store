@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.config.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_config') }}">{{ trans('auth.config.edit_title') }}</a></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
    			@php
                  	$forms = trans('auth.config.form');
                  	$acceptAdmin = [
                  		'web_info', 'payment_method', 'off'
                  	];
                @endphp
                {!! Utils::generateForm($form, $config, $name, false, $data) !!}
                @include('auth.common.button_footer', ['name' => $name, 'back_url' => route('auth_' . $name)])
            </form>
		</div>
	</div>
</section>
@endsection
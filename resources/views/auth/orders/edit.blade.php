@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.orders.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_orders') }}">{{ trans('auth.sidebar.orders') }}</a></li>
    <li class="active">{{ trans('auth.orders.edit_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@php
              	$data->payment_method = trans('shop.cart.payment.' . $data->payment_method);
            @endphp
            @include('auth.form')
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ isset($forms['text']) ? $forms['text'] : trans('auth.edit_box_title') }}</h3>
                </div>
            	<div class="box-body">
            		{!! Utils::generateList($config, $name, $orderDetails, $data, 'table_product_header') !!}
            	</div>
            </div>
            @include('auth.common.button_footer',['back_url' => route('auth_orders')])
		</div>
	</div>
</section>
@endsection

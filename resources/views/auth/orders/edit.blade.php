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
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			@include('auth.common.alert')
			@php
              	$forms = trans('auth.orders.form');
              	$order->payment_method = trans('shop.cart.payment.' . $order->payment_method);
            @endphp
            @foreach($forms as $key=>$form)
            @include('auth.common.edit_form', ['forms' => $form, 'data' => $order])
            @endforeach
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ isset($forms['text']) ? $forms['text'] : trans('auth.edit_box_title') }}</h3>
                </div>
            	<div class="box-body">
            		<table class="table table-hover">
            			<thead>
                            <tr>
                              <th>{{ trans('auth.orders.table_header.images') }}</th>
                              <th>{{ trans('auth.orders.table_header.products') }}</th>
                              <th>{{ trans('auth.orders.table_header.qty') }}</th>
                              <th>{{ trans('auth.orders.table_header.price') }}</th>
                              <th>{{ trans('auth.orders.table_header.cost') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orderDetails as $detail)
                        <tr>
                          <td><img src="{{ $detail->getFirstImage($detail->product_id) }}" width="{{ Common::ADMIN_IMAGE_WIDTH }}" /></td>
                          <td>{{ $detail->name }}</td>
                          <td>{{ $detail->qty }}</td>
                          <td>{{ number_format($detail->price) }}</td>
                          <td>{{ number_format($detail->cost) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        	<tr>
                    			<th class="empty" colspan="3"></th>
                    			<th>{{ trans('shop.cart.table.subtotal') }}</th>
                    			<th colspan="2" class="sub-total">{{ number_format($order->total) }}</th>
                    		</tr>
                    		<tr>
                    			<th class="empty" colspan="3"></th>
                    			<th>{{ trans('shop.cart.table.total') }}</th>
                    			<th colspan="2" class="total">{{ number_format($order->total) }}</th>
                    		</tr>
                        </tfoot>
                    </table>
            	</div>
            </div>
            @include('auth.common.button_footer',['back_url' => route('auth_orders')])
            </form>
		</div>
	</div>
</section>
@endsection

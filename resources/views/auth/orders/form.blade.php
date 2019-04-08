@extends('layouts.app')

@section('content')
@include('auth.common.content_header')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="col-md-6">
        			<div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">{{ trans('auth.orders.order_info_title') }}</h3>
                        </div>
                    	<div class="box-body">
                    		@php
                    			$table_infos = trans('auth.' . $name . '.table_product_header');
                    		@endphp
                    		<table class="table table-hover" style="table-layout: fixed; word-wrap:break-word;">
                    			<thead>
                    				<tr>
                        				@foreach($table_infos as $tbl)
                        				<col width="{{ $tbl['width'] }}">
                        				@endforeach
                        				@foreach($table_infos as $tbl)
                        				<th>{{ $tbl['text'] }}</th>
                        				@endforeach
                    				</tr>
                    			</thead>
                    			<tbody>
                    				@foreach($data->getOrderDetails() as $orderDetail)
                    				@php
                    					$product_info = $orderDetail->getProductInfo();
                    				@endphp
                    				<tr>
                    					<td>{{ $product_info->id }}</td>
                        				<td><img src="{{ $product_info->getFirstImage('small') }}" width="55px" /></td>
                        				<td>{{ $product_info->getName() }}</td>
                        				<td>{{ $orderDetail->qty }}</td>
                        				<td>{{ $orderDetail->getPrice() }}</td>
                        				<td>{{ $orderDetail->getCost() }}</td>
                    				</tr>
                    				@php
                    					$product_detail_infos = $orderDetail->getProductDetailList();
                    				@endphp
                    				@foreach($product_detail_infos as $product_detail)
                    				<tr>
                    					<td></td>
                        				<td></td>
                        				<td><b>{{ $product_detail->group_name }}:</b> {{ $product_detail->name }}</td>
                        				<td>{{ $product_detail->qty }}</td>
                        				<td>{{ $product_detail->getPrice() }}</td>
                        				<td>{{ $product_detail->getCost() }}</td>
                    				</tr>
                    				@endforeach
                    				@endforeach
                    			</tbody>
                    			<tfoot>
                    				<tr>
                    					<td colspan="4" align="right">
                    					<td><b>Tổng cộng</b></td>
                    					<td>{{ $data->getTotal() }}</td>
                    				</tr>
                    			</tfoot>
                    		</table>
                    	</div>
                    </div>
                </div>
                <div class="col-md-6">
    			{!! Utils::generateForm($config, $name, $data) !!}
    			</div>
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
	var validateObject = {!! Utils::generateValidation($name, $rules, $data) !!}
    var validatorEventSetting = $("#submit_form").validate({
        ignore: '',
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	var parent = jelm.parent().parent();
        	parent.removeClass('has-error');
        	parent.find('.help-block').empty();
    	},
    	rules: validateObject.rules,
    	messages: validateObject.messages,
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });
</script>
@endsection
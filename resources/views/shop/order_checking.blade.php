@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<section class="page">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
    			<div id="recover-password" class="form-signup">
    				<form accept-charset="UTF-8" action="{{ route('account_recover') }}" id="recover_customer_password" method="post">
    					{{ csrf_field() }}
        				<div class="form-signup clearfix">
        					<div class="row">
            					<div class="col-md-6">
                					<fieldset class="form-group">
                						<label>{{ trans('shop.order_checking.email') }}: </label>
                						<input type="email" class="form-control form-control-lg" value="" name="checking_email" id="checking_email" placeholder="{{ trans('shop.order_checking.email') }}">
                					</fieldset>
            					</div>
        					</div>
        				</div>
        				<div class="action_bottom">
        					<button type="button" class="btn btn-primary">{{ trans('shop.button.order_checking') }}</button>
        				</div>
    				</form>
    			</div>
    		</div>
		</div>
	</div>
</section>
@endsection

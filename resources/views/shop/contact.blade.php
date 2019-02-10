@extends('layouts.shop')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="mapouter">
				<iframe width="550" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=10.762402%2C%20106.663424&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</div>
		</div>
		<div class="col-md-6">
    		<form role="form" id="create_form" action="?" method="post" enctype="multipart/form-data">
    			<div class="billing-details">
    				<div class="section-title">
    					<h3 class="title">{{ trans('shop.contact.title') }}</h3>
    				</div>
    				<div class="form-group">
    					<input class="input" type="text" name="name" maxlength="200" placeholder="{{ trans('shop.contact.name') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="email" name="email" maxlength="200" placeholder="{{ trans('shop.contact.email') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="tel" name="tel" maxlength="15" placeholder="{{ trans('shop.contact.phone') }}">
    				</div>
    				<div class="form-group">
    					<textarea class="form-control" rows="5" placeholder="{{ trans('shop.contact.comment') }}"></textarea>
    				</div>
    				<div class="pull-right">
    					<button class="primary-btn" id="checkout">{{ trans('shop.button.send') }}</button>
    				</div>
    			</div>
			</form>
		</div>
	</div>
</div>
@endsection

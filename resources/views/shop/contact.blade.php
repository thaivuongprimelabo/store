@extends('layouts.shop')

@section('content')

<div class="container">
	@include('shop.common.alert')
	<div class="row">
		<div class="col-md-6">
			<div class="mapouter">
				<iframe width="550" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=10.762402%2C%20106.663424&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</div>
		</div>
		<div class="col-md-6">
    		<form role="form" id="contact_form" action="?" method="post" enctype="multipart/form-data">
    			{{ csrf_field() }}
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
    					<input class="input" type="tel" name="phone" maxlength="15" placeholder="{{ trans('shop.contact.phone') }}">
    				</div>
    				<div class="form-group">
    					<input class="input" type="tel" name="subject" maxlength="15" placeholder="{{ trans('shop.contact.subject') }}">
    				</div>
    				<div class="form-group">
    					<textarea class="form-control" name="content" rows="5" placeholder="{{ trans('shop.contact.comment') }}"></textarea>
    				</div>
    				<div class="form-group captcha">
    					<span id="captcha-img">{!! captcha_img('flat') !!}</span>
    					<button id="refresh" type="button" class="btn btn-success"><i class="fa fa-refresh"></i></button>
    					<input class="input" type="text" id="captcha" name="captcha" maxlength="255" placeholder="{{ trans('shop.register_form.captcha') }}">
    					<span id="captcha-error" class="valid-text"></span>
    				</div>
    				<div class="pull-right">
    					<button type="button" class="primary-btn" id="send">{{ trans('shop.button.send') }}</button>
    				</div>
    			</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var validator = $("#contact_form").validate({
        	onfocusout: false,
        	rules: {
        		name: {
            		required: true
        		},
        		email: {
        			required: true,
        			email: true
        		},
        		phone: {
        			required: true,
        			number: true
        		},
        		subject: {
    				required: true
        		},
        		content: {
    				required: true
        		},
        		captcha: {
        			required: true
        		}
        	},
        	messages: {
        		name : {
        			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
        		},
        		email : {
        			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
        			email : "{{ trans('validation.email') }}"
        		},
        		phone : {
        			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
        			number: "{{ trans('validation.numeric') }}"
        		},
        		subject: {
        			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
        		},
        		content: {
        			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
        		},
        		captcha: {
        			required : "{{ Utils::getValidateMessage('validation.shop_required', '') }}",
        		}
        	},
        	submitHandler: function(form) {
        		form.submit();
            }
        });

        $('#refresh').click(function(){
      		  $.ajax({
      		     type:'GET',
      		     url:'{{ route('refreshcaptcha') }}',
      		     success:function(data){
      		        $("#captcha-img").html(data.captcha);
      		     }
      		  });
  		});

  		$('#send').click(function(){
  			 if($("#contact_form").valid()) {
  				 var data = {
  					type : 'post',
  					async : false,
  					page: 'checkcaptcha',
  					captcha: $('#captcha').val(),
  					container: '#captcha-error',
  				 }

  				 if(checkCaptcha('{{ route('checkCaptcha') }}', data)) {
  					 $("#contact_form").submit();
  				 }

  			 }
  		});
    });

</script>
@endsection

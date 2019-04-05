@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container container-fix-hd contact margin-bottom-30">
	<div class="box-heading hidden relative">
		<h1 class="title-head">Liên hệ</h1>
	</div>	
	<h2 class="title-head"><span> Gửi tin nhắn cho chúng tôi</span></h2>
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-6">
					<div id="login">
						@include('shop.common.alert')
						<form accept-charset="UTF-8" action="?" id="contact" method="post">
							{{ csrf_field() }}
    						<div id="emtry_contact" class="form-signup form_contact clearfix">
    							<div class="row row-8Gutter">
    								<div class="col-md-12">
    									<fieldset class="form-group">							
    										<input type="text" placeholder="{{ trans('shop.contact.name') }}" name="name" id="name" class="form-control  form-control-lg" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">							
    										<input type="email" placeholder="{{ trans('shop.contact.email') }}" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,63}$" data-validation="email" id="email" class="form-control form-control-lg" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">						
    										<input type="tel" placeholder="{{ trans('shop.contact.phone') }}" name="phone" class="form-control form-control-lg fixnumber" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">						
    										<input type="text" placeholder="{{ trans('shop.contact.subject') }}" name="subject" class="form-control form-control-lg" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">							
            								<textarea placeholder="{{ trans('shop.contact.comment') }}" name="content" class="form-control form-control-lg" rows="6" required=""></textarea>
            							</fieldset>
    								</div>
    								<div class="col-md-12 form-inline">
    									<span id="captcha-img">{!! captcha_img('flat') !!}</span>
    									<fieldset class="form-group">
    										<input type="text" placeholder="{{ trans('shop.contact.captcha') }}" name="captcha" class="form-control form-control-lg" required="">					
    									</fieldset>
    								</div>
    							</div>
    							<div class="mt-2">
    								<button tyle="summit" class="btn btn-primary" style="padding:0 40px;text-transform: inherit;">{{ trans('shop.button.send_contact') }}</button>
    							</div> 
    						</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="contact-box-info clearfix margin-bottom-30">
						<div>
							<div class="item">		

								<div><i class="fa fa-map-marker"></i> 
									<div class="info">
										<label>{{ trans('shop.address_txt') }}</label>
										{{ $config['web_address'] }}
									</div>
								</div>
								<div>
									<i class="fa fa-phone"></i> 
									<div class="info">
										<label>{{ trans('shop.hotline_txt') }}</label>
										<a href="tel:{{ $config['web_hotline'] }}">{{ $config['web_hotline'] }}</a>
										<p>{{ $config['web_working_time'] }}</p>
									</div>
								</div>
								<div><i class="fa fa-envelope"></i> 
									<div class="info">
										<label>Email</label>
										<a href="mailto:{{ $config['web_email'] }}">{{ $config['web_email'] }}
										</a>
									</div>
								</div>																			
								
							</div>
							

						</div>		

					</div>
				</div>

			</div>
		</div>
		<div class="col-sm-12">
			<div class="box-maps margin-bottom-30">
				<div class="iFrameMap">
					<div class="google-map">
						<div id="contact_map" class="map"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<style>
	.google-map {width:100%;}
	.google-map .map {width:100%; height:450px; background:#dedede}
</style>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOvgMzMavm0loFdwqNrzzVh42X_-lDZ3w&callback=initMap"></script>

<script src="//bizweb.dktcdn.net/100/308/325/themes/665783/assets/jquery.gmap.min.js?1554441903190" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

    	$('#contact_map').gMap({
			zoom: 16,
		    scrollwheel: false,
		    maptype: 'ROADMAP',
		    markers:[{
    		   		address: '{{ $config['web_address'] }}',
    		   		html: '_address'
		   		}]
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

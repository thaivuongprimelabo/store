@php
	$subFooter = Utils::createNavigation('sub_footer');
@endphp
<footer class="footer">
	<div class="content">
		<div class="site-footer">

			<div class="footer-inner padding-top-35 pb-lg-5">
				<div class="container">
					<div class="row">

						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.main_nav.contact.text') }}</span></h3>
									
								<ul class="list-menu list-showroom">		 						
									
									<li class="clearfix"><i class="block_icon fa fa-map-marker"></i> <p>
										{{ $config['web_address'] }}
										</p></li>

									<li class="clearfix"><i class="block_icon fa fa-phone"></i>
										<a href="tel:{{ $config['web_hotline'] }}">{{ $config['web_hotline'] }}</a>
										<p>{{ $config['web_working_time'] }}</p>
									</li>
									<li class="clearfix"><i class="block_icon fa fa-envelope"></i>
										<a href="mailto:{{ $config['web_email'] }}">{{ $config['web_email'] }}</a>

									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.category_txt') }}</span></h3>
								{!! $subFooter !!}
							</div>
						</div>


						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.support_customer_txt') }}</span></h3>
								{!! $subFooter !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="footer-widget">
								<h3 class="margin-bottom-20 hastog"><span>{{ trans('shop.facebook_fanpage') }}</span></h3>
								<div class="list-menu">
									<div id="fb-root"></div>
									@if(!Utils::blank($config['facebook_fanpage']))
									<div id="fb-root"></div>
									<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=135671569954053&autoLogAppEvents=1"></script>
									<div class="fb-page" data-href="{{ $config['facebook_fanpage'] }}" data-tabs="timeline" data-width="270" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{ $config['facebook_fanpage'] }}" class="fb-xfbml-parse-ignore"><a href="{{ $config['facebook_fanpage'] }}"></a></blockquote></div>
									@endif
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="copyright clearfix">
				<div class="container">
					<div class="inner clearfix">
						<div class="row">
							<div class="col-md-4 text-center text-lg-left">
								{!! $config['footer_text'] !!}
							</div>
							<div class="col-md-8 text-center text-lg-right hidden-xs">
								{!! Utils::createNavigation('footer') !!}
							</div>

						</div>
					</div>
					
					<div class="back-to-top">
						<i class="fa  fa-angle-up"></i>
					</div>
					

					<a href="tel:01676435063" class="suntory-alo-phone bottom-left  suntory-alo-green " id="suntory-alo-phoneIcon">

						<div class="suntory-alo-ph-img-circle"><i class="fa fa-phone"></i></div>
					</a>

				</div>
			</div>
		</div>

	</div>
</footer>
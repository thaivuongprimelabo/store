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
								<h3 class="hastog"><span>Liên hệ</span></h3>
									
								<ul class="list-menu list-showroom">		 						
									
									<li style="padding-left: 0;"><p>Chúng tôi chuyên cung cấp các sản phẩm thực phẩm sạch an toàn cho sức khỏe con người</p></li>

									<li class="clearfix"><i class="block_icon fa fa-map-marker"></i> <p>
										
										
										
										{{ $config['web_address'] }}
											
										</p></li>

									<li class="clearfix"><i class="block_icon fa fa-phone"></i>
										<a href="tel:01676435063">{{ $config['web_hotline'] }}</a>
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
								<h3 class="margin-bottom-20 hastog"><span>Kết nối với Dualeo</span></h3>
								<div class="list-menu">
									<div id="fb-root"></div>
									
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
								<span>© Bản quyền thuộc về <b>Dualeo</b> <b class="fixline">|</b> Cung cấp bởi <a href="https://www.sapo.vn/?utm_campaign=cpn%3Asite_khach_hang-plm%3Afooter&amp;utm_source=site_khach_hang&amp;utm_medium=referral&amp;utm_content=fm%3Atext_link-km%3A-sz%3A&amp;utm_term=&amp;campaign=site_khach_hang" rel="nofollow" title="Sapo" target="_blank">Sapo</a></span>
								
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
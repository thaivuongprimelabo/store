<div class="topbar-mobile hidden-lg hidden-md text-center text-md-left">
	<div class="container">
		<i class="fa fa-mobile" style=" font-size: 20px; display: inline-block; position: relative; transform: translateY(2px); "></i> Hotline: 
		<span>
													
			<a href="callto:01676435063"> {{ $config['web_hotline'] }}</a>
					
		</span>
	</div>
</div>
<div class="topbar hidden-sm hidden-xs">
	<div class="container">
		<div>
			<div class="row">
				<div class="col-sm-6 col-md-9 a-left">
					<ul class="list-inline f-left">
						<li>
							<i class="fa fa-mobile" style=" font-size: 20px; display: inline-block; position: relative; transform: translateY(2px); "></i> {{ trans('shop.hotline_txt') }}: 
							<span>
																		
								<a href="callto:01676435063"> {{ $config['web_hotline'] }}</a>
										
							</span>
						</li>
						<li class="margin-left-20">
							<i class="fa fa-map-marker"></i> <b>Địa chỉ</b>: 
							<span>
								{{ $config['web_address'] }}
							</span>

						</li>
					</ul>

				</div>
				<div class="col-sm-6 col-md-3">

					<ul class="list-inline f-right">
						
						<li>
							<a data-toggle="modal" data-target="#dangnhap" href="https://dualeo-x.bizwebvietnam.net/account/login"><i class="fa fa-user"></i> {{ trans('shop.button.login') }}</a>

						</li>
						<li><span>hoặc</span></li>
						<li><a data-toggle="modal" data-target="#dangky" href="https://dualeo-x.bizwebvietnam.net/account/register">{{ trans('shop.button.register') }}</a>

						</li>
						

						<li class="li-search hidden"><a href="javscrript:;">
							<i class="fa fa-search"></i></a>
							<div class="dropdown topbar-dropdown hidden-md hidden-sm hidden-xs">
								<div class="content a-center">										
									<div class="header_search search_form">
										<form class="input-group search-bar search_form" action="https://dualeo-x.bizwebvietnam.net/search" method="get" role="search">		
											<input type="search" name="query" value="" placeholder="{{ trans('shop.search_txt') }}" class="input-group-field st-default-search-input search-text" autocomplete="off">
											<span class="input-group-btn">
												<button class="btn icon-fallback-text">
													<i class="fa fa-search"></i>
												</button>
											</span>
										</form>
									</div>
								</div>									
							</div>
						</li>
					</ul>

				</div>

			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="header-content clearfix a-center">
		<div class="row">
			<div class="col-xs-12 col-md-3 text-lg-left">
				<div class="logo inline-block">
					
					<a href="index.html" class="logo-wrapper ">					
						<img src="{{ Utils::getImageLink($config['web_logo']) }}" alt="logo ">					
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-md-8 col-lg-7 hidden-xs">
				<div class="policy d-flex justify-content-around">
					<div class="item-policy d-flex align-items-center">
						<a href="#">
							<img src="{{ url('shop/bizweb.dktcdn.net/thumb/medium/100/308/325/themes/665783/assets/policy14d7c.png') }}"  alt="DuaLeo-X" >
						</a>
						<div class="info a-left">
							<a href="#">{{ trans('shop.free_ship_txt') }}</a>
							<p>Bán kính 100 km</p>
						</div>
					</div>	
					<div class="item-policy d-flex align-items-center">
						<a href="#">
							<img src="{{ url('shop/bizweb.dktcdn.net/thumb/medium/100/308/325/themes/665783/assets/policy24d7c.png') }}"  alt="DuaLeo-X" >
						</a>
						<div class="info a-left">
							<a href="#">{{ trans('shop.support_txt') }}</a>
							<p>{{ trans('shop.hotline_txt') }}: <a href="callto:{{ $config['web_hotline'] }}"> {{ $config['web_hotline'] }}</a></p>
						</div>
					</div>	
					<div class="item-policy d-flex align-items-center">
						<a href="#">
							<img src="{{ url('shop/bizweb.dktcdn.net/thumb/medium/100/308/325/themes/665783/assets/policy34d7c.png') }}"  alt="DuaLeo-X" >
						</a>
						<div class="info a-left">
							<a href="#">{{ trans('shop.working_txt') }}</a>
							<p>{{ $config['web_working_time'] }}</p>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-xs-12 col-md-1 col-lg-2 hidden-sm hidden-xs">
				<div class="top-cart-contain f-right ">
					<div class="mini-cart text-xs-center">
						<div class="heading-cart">
							<a href="https://dualeo-x.bizwebvietnam.net/cart">
								<div class="icon f-left relative">
									<i class="fa fa-shopping-bag"></i>
									<span class="cartCount count_item_pr hidden-lg" id="cart-total">0</span>
								</div>
								<div class="right-content hidden-md">
									<span class="label">{{ trans('shop.cart_txt') }}</span>
									(<span class="cartCount2">0</span>)
								</div>
							</a>
						</div>
						<div class="top-cart-content">
							<ul id="cart-sidebar" class="mini-products-list count_li">
								<li class="list-item">
									<ul></ul>
								</li>
								<li class="action">
									<ul>
										<li class="li-fix-1">
											<div class="top-subtotal">
												{{ trans('shop.cart.txt') }}:
												<span class="price"></span>
											</div>
										</li>
										<li class="li-fix-2" style="">
											<div class="actions">
												<a href="https://dualeo-x.bizwebvietnam.net/cart" class="btn btn-primary">
													<span>{{ trans('shop.cart.txt') }}</span>
												</a>
												<a href="https://dualeo-x.bizwebvietnam.net/checkout" class="btn btn-checkout btn-gray">
													<span>{{ trans('shop.button.checkout') }}</span>
												</a>
											</div>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="menu-bar hidden-md hidden-lg">
		<img src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/menu-bar4d7c.png') }}" alt="menu bar" />
	</div>
	<div class="icon-cart-mobile hidden-md hidden-lg f-left absolute" onclick="window.location.href='https://dualeo-x.bizwebvietnam.net/cart'">
		<div class="icon relative">
			<i class="fa fa-shopping-bag"></i>
			<span class="cartCount count_item_pr">0</span>
		</div>
	</div>
</div>
<!-- /HEADER -->
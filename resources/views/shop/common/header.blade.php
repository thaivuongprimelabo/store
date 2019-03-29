<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<span>{{ trans('shop.welcome_txt') . $config['web_name'] }}</span>
			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">VN <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a href="#">Vietnam (VN)</a></li>
							<li><a href="#">English (ENG)</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /top Header -->

	<!-- header -->
	<div id="header">
		<div class="container">
			<div class="pull-left">
				<!-- Logo -->
				<div class="header-logo">
					<a class="logo" href="/">
						<img src="{{ $config['web_logo'] }}" alt="">
					</a>
				</div>
				<!-- /Logo -->

				<!-- Search -->
				<div class="header-search">
					<form method="post" action="{{ route('search') }}">
						{{ csrf_field() }}
						<input name="keyword" class="input search-input" type="text" placeholder="{{ trans('shop.enter_keyword') }}">
						<select class="input search-categories" name="category_id">
							<option value="">{{ trans('shop.search_all_categories') }}</option>
							{!! Utils::createSelectList(Common::CATEGORIES) !!}
						</select>
						<button class="search-btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<!-- /Search -->
			</div>
			<div class="pull-right">
				<ul class="header-btns">
					<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">{{ trans('shop.my_account') }} <i class="fa fa-caret-down"></i></strong>
							</div>
							
							@if(Auth::guard('member')->check())
							<a href="#" class="text-uppercase" title="{{ Auth::guard('member')->user()->name }}">{{ str_limit(Auth::guard('member')->user()->name, 9) }}</a>
							<ul class="custom-menu">
								<li><a href="#"><i class="fa fa-user-o"></i> {{ trans('shop.password') }}</a></li>
								<li><a href="#"><i class="fa fa-check"></i> {{ trans('shop.history') }}</a></li>
								<li><a href="{{ route('member_logout') }}"><i class="fa fa-unlock-alt"></i> {{ trans('shop.logout') }}</a></li>
							</ul>
							@else
							<a href="{{ route('member_login') }}" class="text-uppercase">{{ trans('shop.login') }}</a>
							<ul class="custom-menu">
								<li><a href="{{ route('member_login') }}"><i class="fa fa-user-plus"></i> {{ trans('shop.register') }}</a></li>
							</ul>
							@endif
						</li>
						<!-- /Account -->
					<!-- Cart -->
					<li class="header-cart dropdown default-dropdown" id="top-cart">
						{!! Cart::topCart() !!}
					</li>
					<!-- /Cart -->

					<!-- Mobile nav toggle-->
					<li class="nav-toggle">
						<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
					</li>
					<!-- / Mobile nav toggle -->
				</ul>
			</div>
		</div>
		<!-- header -->
	</div>
	<!-- container -->
</header>
<!-- /HEADER -->
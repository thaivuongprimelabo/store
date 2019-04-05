<nav>
	<div class="container">
		<div class="hidden-sm hidden-xs">
			{!! Utils::createNavigation() !!}	

			<div class="menu-search f-right bbbbb">										
				<div class="header_search search_form">
					<form class="input-group search-bar search_form" action="?" method="get" role="search">		
						<input type="search" id="keyword" value="" placeholder="{{ trans('shop.search_product') }}" class="input-group-field st-default-search-input search-text auto-search" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn icon-fallback-text">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</form>
					<div id="search_suggestion" style="display: none; left: 0px; top: 52px; width: 252px;">
                        <div id="search_top">
                        		<h3>{{ trans('shop.search_suggestion') }}</h3>
                                <div id="product_results">
                                </div>
                                <div id="article_results"></div>
                        </div>
                        <div id="search_bottom">
                                <a class="show_more" href="javascript:void(0)">Hiển thị tất cả kết quả
                                        cho "<span>d</span>"
                                </a>
                        </div>
                </div>
				</div>
			</div>	
		</div>
		<div class="hidden-lg hidden-md menu-offcanvas">
			<div class="head-menu clearfix">
				<ul class="list-inline">
					
					<li>
						<a href="https://dualeo-x.bizwebvietnam.net/account/login"><i class="fa fa-user"></i> {{ trans('shop.button.login') }}</a>

					</li>
					<li><span>hoặc</span></li>
					<li><a href="https://dualeo-x.bizwebvietnam.net/account/register">{{ trans('shop.button.register') }}</a>						
					</li>
					

					<li class="li-search">
						<div class="header_search search_form">
                        	<form class="input-group search-bar search_form" action="#" method="get" role="search">		
                        		<input type="search" name="query" value="" placeholder="Tìm sản phẩm" class="input-group-field st-default-search-input search-text" autocomplete="off">
                        		<span class="input-group-btn">
                        			<button class="btn icon-fallback-text">
                        				<i class="fa fa-search"></i>
                        			</button>
                        		</span>
                        	</form>
						</div>						
					</li>
				</ul>
				<div class="menuclose"><i class="fa fa-close"></i></div>
			</div>
			{!! Utils::createNavigation('mobile') !!}
		</div>
	</div>
</nav>
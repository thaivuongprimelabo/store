<nav>
	<div class="container">
		<div class="hidden-sm hidden-xs">
			{!! Utils::createNavigation() !!}	

			<div class="menu-search f-right bbbbb">										
				<div class="header_search search_form">
					<form class="input-group search-bar search_form" action="https://dualeo-x.bizwebvietnam.net/search" method="get" role="search">		
						<input type="search" name="query" value="" placeholder="Tìm sản phẩm" class="input-group-field st-default-search-input search-text auto-search" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn icon-fallback-text">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</form>
				</div>
			</div>	
		</div>
		<div class="hidden-lg hidden-md menu-offcanvas">
			<div class="head-menu clearfix">
				<ul class="list-inline">
					
					<li>
						<a href="https://dualeo-x.bizwebvietnam.net/account/login"><i class="fa fa-user"></i> Đăng nhập</a>

					</li>
					<li><span>hoặc</span></li>
					<li><a href="https://dualeo-x.bizwebvietnam.net/account/register">Đăng ký</a>						
					</li>
					

					<li class="li-search">
						<div class="header_search search_form">
                        	<form class="input-group search-bar search_form" action="https://dualeo-x.bizwebvietnam.net/search" method="get" role="search">		
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
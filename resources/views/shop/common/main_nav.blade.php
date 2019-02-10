<!-- NAVIGATION -->
<div id="navigation">
	<!-- container -->
	<div class="container">
		<div id="responsive-nav">
			<!-- category nav -->
			<div class="category-nav {{ $showSidebar == 'hide' ? 'show-on-click' : '' }}">
				<span class="category-header">Danh mục sản phẩm <i class="fa fa-list"></i></span>
				<ul class="category-list">
					{!! Utils::createSidebar('shop', $config['url_ext']) !!}
				</ul>
			</div>
			<!-- /category nav -->

			<!-- menu nav -->
			<div class="menu-nav">
				<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
				<ul class="menu-list">
					{!! Utils::createMainNav() !!}
				</ul>
			</div>
			<!-- menu nav -->
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /NAVIGATION -->
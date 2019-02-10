<!-- HOME -->
<div id="home">
	<!-- container -->
	<div class="container">
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div id="home-slick">
				@foreach($banners as $banner)
				<!-- banner -->
				<div class="banner banner-1">
					<img src="{{ Utils::getImageLink($banner->banner) }}" alt="">
				</div>
				<!-- /banner -->
				@endforeach
			</div>
			<!-- /home slick -->
		</div>
		<!-- /home wrap -->
	</div>
	<!-- /container -->
</div>
<!-- /HOME -->
<!-- HOME -->
<div id="home">
	<!-- container -->
	<div class="container">
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div id="home-slick">
				@php
					$demension = explode('x', $config['banner_image_size']);
				@endphp
				@foreach($banners as $banner)
				<!-- banner -->
				<div class="banner banner-1">
					@if($banner->select_type == 'use_image')
					<img src="{{ Utils::getImageLink($banner->banner) }}" alt="" style="width: {{ $demension[0] }}px; height: {{ $demension[1] }}px;">
					@else
					<iframe width="{{ $demension[0] }}" height="{{ $demension[1] }}" src="https://www.youtube.com/embed/{{ $banner->youtube_id }}" frameborder="0" allowfullscreen></iframe>
					@endif
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